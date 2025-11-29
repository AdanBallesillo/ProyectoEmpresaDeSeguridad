<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardReportesController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

    public function asistencia(Request $request)
    {
        $periodo = $request->input('periodo', 'Mes'); // Semana / Mes / Año

        // FILTRADO DE DATOS
        $query = DB::table('asistencias')
            ->join('empleados', 'empleados.id_empleado', '=', 'asistencias.empleado_id')
            ->select(
                'empleados.nombres',
                'empleados.apellidos',
                'asistencias.hora_entrada',
                'asistencias.hora_salida',
                'asistencias.status_asistencia',
                'asistencias.fecha_registro'
            );

        // FILTRO REAL POR PERIODO
        if ($periodo === 'Semana') {
            $query->whereBetween('asistencias.fecha_registro', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
        } elseif ($periodo === 'Mes') {
            $query->whereYear('asistencias.fecha_registro', now()->year)
                ->whereMonth('asistencias.fecha_registro', now()->month);
        } elseif ($periodo === 'Año') {
            $query->whereYear('asistencias.fecha_registro', now()->year);
        }

        $asistencia = $query->orderBy('empleados.nombres')->get();

        // === MÉTRICAS ===
        $presentes = $asistencia->where('status_asistencia', 'A tiempo')->count()
                    + $asistencia->where('status_asistencia', 'Tarde')->count(); // ambos asistieron

        $tardanzas = $asistencia->where('status_asistencia', 'Tarde')->count();
        $ausentes  = $asistencia->where('status_asistencia', 'Falta')->count();

        $total = $presentes + $tardanzas + $ausentes;

        $puntualidad = $total == 0 ? 0 : round(($presentes / $total) * 100);

        return view('Jefe.IndexReportes', compact(
            'asistencia',
            'presentes',
            'tardanzas',
            'ausentes',
            'puntualidad',
            'periodo'
        ));
    }

}
