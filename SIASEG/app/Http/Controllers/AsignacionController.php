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
                'asignaciones_turnos.created_at',
                'estaciones.nombre_estacion'
            )
            ->get();

        // SOLO usuarios con rol Empleado
        $users = Employed::where('rol', 'Empleado')
            ->where('status', 'Activo')
            ->orderBy('nombres')
            ->paginate(10);

        return view('Jefe.AsignacionPersonal', compact(
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
        $empleadosSeleccionados = array_unique($request->empleados);
        $turno = $request->turno;

        // Límite de personal de la estación
        $estacion = Estacion::findOrFail($estacionId);
        $limite = $estacion->p_requerido ?? 0;

        if ($limite > 0 && count($empleadosSeleccionados) > $limite) {
            return back()
                ->with('error', "La estación '{$estacion->nombre_estacion}' solo requiere {$limite} empleados.")
                ->withInput();
        }

        DB::beginTransaction();

        try {

            // ============================================
            // OBTENER ASIGNACIONES ACTUALES DE ESTA ESTACIÓN Y TURNO
            // ============================================
            $empleadosActualmente = DB::table('asignaciones_turnos')
                ->where('id_estacion', $estacionId)
                ->where('turno', $turno)
                ->pluck('id_empleado')
                ->toArray();

            // ============================================
            // DETERMINAR QUIÉNES SE ELIMINAN Y QUIÉNES SE INSERTAN
            // ============================================
            $paraEliminar = array_diff($empleadosActualmente, $empleadosSeleccionados);
            $paraInsertar = array_diff($empleadosSeleccionados, $empleadosActualmente);

            // ============================================
            // ELIMINAR EMPLEADOS DESMARCADOS
            // ============================================
            if (!empty($paraEliminar)) {
                DB::table('asignaciones_turnos')
                    ->where('id_estacion', $estacionId)
                    ->where('turno', $turno)
                    ->whereIn('id_empleado', $paraEliminar)
                    ->delete();
            }

            // ============================================
            // INSERTAR NUEVAS ASIGNACIONES
            // ============================================
            if (!empty($paraInsertar)) {
                $now = Carbon::now();
                $toInsert = [];

                foreach ($paraInsertar as $empleadoId) {
                    $toInsert[] = [
                        'id_estacion' => $estacionId,
                        'id_empleado' => $empleadoId,
                        'turno'       => $turno,
                        'created_at'  => $now,
                        'updated_at'  => $now,
                    ];
                }

                DB::table('asignaciones_turnos')->insert($toInsert);
            }

            DB::commit();

            return redirect()
                ->route('jefe.asignar.personal', $estacionId)
                ->with('success', 'Asignaciones actualizadas correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Error al guardar asignaciones: ' . $e->getMessage());

            return back()->with('error', 'Ocurrió un error al guardar las asignaciones.');
        }
    }

}
