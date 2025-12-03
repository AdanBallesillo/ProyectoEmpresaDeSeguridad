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
                'empleados'    => 'nullable|array', // ahora nullable para permitir "desmarcar todo"
                'empleados.*'  => 'integer|exists:empleados,id_empleado',
                'turno'        => 'required|string|in:Matutino,Nocturno',
            ], [
                'estacion_id.required' => 'Selecciona una estación.',
                'turno.required'       => 'Selecciona un turno.',
            ]);

            $estacionId = (int) $request->estacion_id;
            $empleadosSeleccionados = $request->input('empleados') ?? [];
            $empleadosSeleccionados = array_unique($empleadosSeleccionados);
            $turno = $request->turno;

            Log::info('===== INICIO ASIGNACIÓN =====');
            Log::info('Datos recibidos del formulario: ' . json_encode($request->only(['estacion_id','empleados','turno'])));
            Log::info('Procesando asignación para: ' . json_encode([
                'estacion_id' => $estacionId,
                'empleados_seleccionados' => $empleadosSeleccionados,
                'turno' => $turno
            ]));

            // Límite de personal de la estación
            $estacion = Estacion::findOrFail($estacionId);
            $limite = $estacion->p_requerido ?? 0;
            Log::info('Límite de la estación: ' . json_encode(['p_requerido' => $limite]));

            // Si enviaste empleados seleccionados, valida el límite
            if ($limite > 0 && count($empleadosSeleccionados) > $limite) {
                Log::info('Validación: excede límite', ['seleccionados' => count($empleadosSeleccionados), 'limite' => $limite]);
                return back()
                    ->with('error', "La estación '{$estacion->nombre_estacion}' solo requiere {$limite} empleados.")
                    ->withInput();
            }

            DB::beginTransaction();

            try {
                // Obtener empleados actualmente asignados a ESTA estación y ESTE turno
                $empleadosActualmente = DB::table('asignaciones_turnos')
                    ->where('id_estacion', $estacionId)
                    ->where('turno', $turno)
                    ->pluck('id_empleado')
                    ->toArray();

                Log::info('Empleados actualmente asignados: ' . json_encode($empleadosActualmente));

                // Determinar quien se elimina y quien se inserta
                $paraEliminar = array_values(array_diff($empleadosActualmente, $empleadosSeleccionados)); // que estaban y ya no
                $paraInsertar = array_values(array_diff($empleadosSeleccionados, $empleadosActualmente)); // nuevos

                Log::info('Empleados para ELIMINAR: ' . json_encode($paraEliminar));
                Log::info('Empleados para INSERTAR: ' . json_encode($paraInsertar));

                // ELIMINAR DESMARCADOS (si hay)
                if (!empty($paraEliminar)) {
                    $deleted = DB::table('asignaciones_turnos')
                        ->where('id_estacion', $estacionId)
                        ->where('turno', $turno)
                        ->whereIn('id_empleado', $paraEliminar)
                        ->delete();

                    Log::info('Eliminaciones realizadas: ' . $deleted);
                } else {
                    Log::info('No hay empleados para eliminar.');
                }

                // INSERTAR NUEVOS
                $insertedCount = 0;
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
                    $insertedCount = count($toInsert);
                    Log::info('Registros insertados: ' . json_encode($toInsert));
                } else {
                    Log::info('No hay empleados nuevos para insertar.');
                }

                DB::commit();

                Log::info('===== ASIGNACIÓN COMPLETADA EXITOSAMENTE =====', [
                    'inserted' => $insertedCount,
                    'deleted' => count($paraEliminar)
                ]);

                return redirect()
                    ->route('jefe.asignar.personal', $estacionId)
                    ->with('success', 'Asignaciones actualizadas correctamente.');
            } catch (\Throwable $e) {
                DB::rollBack();
                Log::error('Error al guardar asignaciones: ' . $e->getMessage());
                Log::error($e);

                return back()->with('error', 'Ocurrió un error al guardar las asignaciones.');
            }
        }

}
