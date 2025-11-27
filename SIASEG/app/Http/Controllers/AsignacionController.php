<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estacion;
use App\Models\Employed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AsignacionController extends Controller
{
    /**
     * Mostrar formulario de asignación para una estación.
     * Ruta: GET /jefe/asignar/{estacion}
     */
    public function create($idEstacion)
    {
        // Estación actual
        $estacionSeleccionada = (int) $idEstacion;

        // ------------------------------------------------------------------
        // LIMPIAR ASIGNACIONES VENCIDAS (salida simulada = created_at + 3 min)
        // ------------------------------------------------------------------
        DB::table('asignaciones_turnos')
            ->whereDate('fecha', Carbon::today())
            ->whereRaw("DATE_ADD(created_at, INTERVAL 3 MINUTE) <= NOW()")
            ->delete();

        // Estaciones
        $estaciones = Estacion::orderBy('nombre_estacion')->get();

        // Turno seleccionado
        $turnoSeleccionado = request()->query('turno', 'Matutino');

        // Asignaciones activas (después de limpieza)
        $asignaciones = DB::table('asignaciones_turnos')
            ->join('estaciones', 'asignaciones_turnos.id_estacion', '=', 'estaciones.id_estacion')
            ->select(
                'asignaciones_turnos.id_empleado',
                'asignaciones_turnos.id_estacion',
                'asignaciones_turnos.turno',
                'asignaciones_turnos.fecha',
                'asignaciones_turnos.created_at',
                'estaciones.nombre_estacion'
            )
            ->whereDate('asignaciones_turnos.fecha', Carbon::today())
            ->get();

        // Empleados paginados
        $users = Employed::orderBy('nombres')->paginate(10);

        return view('Jefe.asignacionpersonal', compact(
            'estaciones',
            'users',
            'asignaciones',
            'estacionSeleccionada',
            'turnoSeleccionado'
        ));
    }


    /**
     * Guardar asignaciones en la tabla asignaciones_turnos.
     * Ruta: POST /jefe/asignar  (nombre: asignaciones.store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'estacion_id'  => 'required|integer|exists:estaciones,id_estacion',
            'empleados'    => 'required|array|min:1',
            'empleados.*'  => 'integer|exists:empleados,id_empleado',
            'turno'        => 'required|string|in:Matutino,Nocturno',
        ], [
            'estacion_id.required' => 'Selecciona una estación.',
            'empleados.required'   => 'Selecciona al menos un empleado.',
            'turno.required'       => 'Selecciona un turno.',
        ]);

        $estacionId = (int) $request->estacion_id;
        $empleados  = array_unique($request->empleados);
        $turno      = $request->turno;
        $fecha      = Carbon::today()->toDateString();

        // Límite de personal de la estación
        $estacion = Estacion::findOrFail($estacionId);
        $limite   = $estacion->p_requerido ?? 0;

        if ($limite > 0 && count($empleados) > $limite) {
            return back()
                ->with('error', "La estación '{$estacion->nombre_estacion}' solo requiere {$limite} empleados.")
                ->withInput();
        }

        DB::beginTransaction();

        try {
            // Empleados ya asignados HOY en ESTA estación y ESTE turno
            $yaAsignadosMismoTurno = DB::table('asignaciones_turnos')
                ->where('id_estacion', $estacionId)
                ->where('turno', $turno)
                ->whereDate('fecha', $fecha)
                ->whereIn('id_empleado', $empleados)
                ->pluck('id_empleado')
                ->toArray();

            // Empleados que ya tienen OTRO turno ese mismo día (para prohibir doble turno)
            $yaEnOtroTurno = DB::table('asignaciones_turnos')
                ->whereDate('fecha', $fecha)
                ->whereIn('id_empleado', $empleados)
                ->where('turno', '!=', $turno)
                ->pluck('id_empleado')
                ->toArray();

            $now = Carbon::now();
            $toInsert = [];

            foreach ($empleados as $idEmpleado) {
                // Si ya está en el mismo turno o en otro turno hoy, se salta
                if (
                    in_array($idEmpleado, $yaAsignadosMismoTurno) ||
                    in_array($idEmpleado, $yaEnOtroTurno)
                ) {
                    continue;
                }

                $toInsert[] = [
                    'id_estacion' => $estacionId,
                    'id_empleado' => $idEmpleado,
                    'turno'       => $turno,
                    'fecha'       => $fecha,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }

            if (!empty($toInsert)) {
                DB::table('asignaciones_turnos')->insert($toInsert);
            }

            DB::commit();

            $added   = count($toInsert);
            $skipped = count($empleados) - $added;

            return redirect()
                ->route('jefe.asignar.personal', $estacionId)
                ->with(
                    'success',
                    "Asignaciones guardadas. Agregados: {$added}. Omitidos (ya tenían turno hoy): {$skipped}."
                );
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al guardar asignaciones: ' . $e->getMessage());

            return back()->with('error', 'Ocurrió un error al guardar las asignaciones.');
        }
    }
}
