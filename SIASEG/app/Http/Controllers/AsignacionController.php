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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $estaciones = Estacion::orderBy('nombre_estacion')->get();

        // estacion y turno seleccionados desde query string (pueden venir o no)
        $estacionSeleccionada = $request->query('estacion_id', null);
        $turnoSeleccionado = $request->query('turno', null);

        // obtener asignaciones completas; si viene turno, filtrar por turno
        $asignacionesQuery = DB::table('asignaciones')
            ->join('estaciones', 'asignaciones.id_estacionPK', '=', 'estaciones.id_estacion')
            ->select(
                'asignaciones.id_usuarioPK',
                'asignaciones.id_estacionPK',
                'asignaciones.turno',
                'estaciones.nombre_estacion'
            );

        if ($turnoSeleccionado) {
            $asignacionesQuery->where('asignaciones.turno', $turnoSeleccionado);
        }

        $asignaciones = $asignacionesQuery->get();

        // empleados con paginación
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'estacion_id' => 'required|integer|exists:estaciones,id_estacion',
            'empleados'    => 'required|array|min:1',
            'empleados.*'  => 'integer|exists:empleados,id_empleado',
            'turno'       => 'required|string|in:Matutino,Vespertino,Nocturno'
        ]);

        $estacionId = $request->input('estacion_id');
        $turno = $request->input('turno');
        $empleadosSeleccionados = array_unique($request->input('empleados'));

        $estacion = Estacion::findOrFail($estacionId);
        $limiteEmpleados = $estacion->p_requerido;

        // VALIDAR LÍMITE
        if (count($empleadosSeleccionados) > $limiteEmpleados) {
            return back()->with('error', "La estación '{$estacion->nombre_estacion}' solo requiere {$limiteEmpleados} empleados.");
        }

        DB::beginTransaction();
        try {

            // ========================
            // OBTENER ASIGNACIONES ACTUALES
            // ========================
            $empleadosActualmente = DB::table('asignaciones')
                ->where('id_estacionPK', $estacionId)
                ->where('turno', $turno)
                ->pluck('id_usuarioPK')
                ->toArray();

            // ========================
            // DETERMINAR CAMBIOS
            // ========================
            $paraEliminar = array_diff($empleadosActualmente, $empleadosSeleccionados);
            $paraInsertar = array_diff($empleadosSeleccionados, $empleadosActualmente);

            // ========================
            // ELIMINAR DESMARCADOS
            // ========================
            if (!empty($paraEliminar)) {
                DB::table('asignaciones')
                    ->where('id_estacionPK', $estacionId)
                    ->where('turno', $turno)
                    ->whereIn('id_usuarioPK', $paraEliminar)
                    ->delete();
            }

            // ========================
            // INSERTAR NUEVOS
            // ========================
            if (!empty($paraInsertar)) {
                $now = Carbon::now();
                $toInsert = [];

                foreach ($paraInsertar as $userId) {
                    $toInsert[] = [
                        'id_estacionPK' => $estacionId,
                        'id_usuarioPK'  => $userId,
                        'turno'        => $turno,
                        'created_at'   => $now,
                        'updated_at'   => $now,
                    ];
                }

                DB::table('asignaciones')->insert($toInsert);
            }

            DB::commit();

            return redirect()->route('asignaciones.create', [
                'estacion_id' => $estacionId,
                'turno'       => $turno
            ])->with('success', 'Asignaciones actualizadas correctamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar asignaciones: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al guardar las asignaciones.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
