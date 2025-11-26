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

        // estacion seleccionada (para edición)
        $estacionSeleccionada = $request->query('estacion_id');

        // turno seleccionado (opcional)
        $turnoSeleccionado = $request->query('turno');

        // obtener asignaciones completas
        $asignaciones = DB::table('asignaciones')
            ->join('estaciones', 'asignaciones.id_estacionPK', '=', 'estaciones.id_estacion')
            ->select(
                'asignaciones.id_usuarioPK',
                'asignaciones.id_estacionPK',
                'asignaciones.turno',
                'estaciones.nombre_estacion'
            )
            ->get();

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
        ], [
            'estacion_id.required' => 'Selecciona una estación.',
            'empleados.required' => 'Selecciona al menos un empleado.',
            'turno.required' => 'Selecciona un turno.'
        ]);

        $estacionId = $request->input('estacion_id');
        $turno = $request->input('turno');
        $empleados = array_unique($request->input('empleados'));

        DB::beginTransaction();
        try {
            // Obtener asignaciones ya existentes para no duplicar
            $existing = DB::table('asignaciones')
                ->where('id_estacionPK', $estacionId)
                ->where('turno', $turno)
                ->whereIn('id_usuarioPK', $empleados)
                ->pluck('id_usuarioPK')
                ->toArray();

            $now = Carbon::now();
            $toInsert = [];

            foreach ($empleados as $userId) {
                if (in_array($userId, $existing)) {
                    // ya asignado -> skip
                    continue;
                }
                $toInsert[] = [
                    'id_estacionPK' => $estacionId,
                    'id_usuarioPK'  => $userId,
                    'turno'        => $turno,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ];
            }

            if (!empty($toInsert)) {
                DB::table('asignaciones')->insert($toInsert);
            }

            DB::commit();

            $added   = count($toInsert);
            $skipped = count($empleados) - $added;

            return redirect()
                ->route('asignaciones.create')
                ->with(
                    'success',
                    "Asignaciones guardadas correctamente. Agregados: {$added}. Omitidos: {$skipped}."
                );

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error al guardar asignaciones: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al guardar las asignaciones.');
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
