<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexAsistenciaController extends Controller
{
    public function index()
    {
        // Fecha de hoy
        $hoy = now()->toDateString();

        // ASISTENCIAS DE HOY
        $asistencias = DB::table('asistencias')
            ->join('empleados', 'asistencias.empleado_id', '=', 'empleados.id_empleado')
            ->leftJoin('estaciones', 'asistencias.estacion_id', '=', 'estaciones.id_estacion')
            ->select(
                'empleados.nombres',
                'empleados.apellidos',
                'estaciones.nombre_estacion',
                'asistencias.hora_entrada',
                'asistencias.hora_salida',
                'asistencias.status_asistencia'
            )
            ->whereDate('asistencias.fecha_registro', $hoy)
            ->orderBy('asistencias.hora_entrada', 'asc')
            ->get();

        // TOP 10 PUNTUALES
        $topPuntuales = DB::table('asistencias')
            ->join('empleados', 'asistencias.empleado_id', '=', 'empleados.id_empleado')
            ->select(
                'empleados.nombres',
                'empleados.apellidos',
                DB::raw('COUNT(*) as total')
            )
            ->where('status_asistencia', 'A tiempo')
            ->groupBy('empleados.id_empleado', 'empleados.nombres', 'empleados.apellidos')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        // TOP 10 RETARDOS / FALTAS
        $topInasistencias = DB::table('asistencias')
            ->join('empleados', 'asistencias.empleado_id', '=', 'empleados.id_empleado')
            ->select(
                'empleados.nombres',
                'empleados.apellidos',
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('status_asistencia', ['Tarde', 'Falta'])
            ->groupBy('empleados.id_empleado', 'empleados.nombres', 'empleados.apellidos')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        return view('Jefe.IndexAsistencia', compact('asistencias', 'topPuntuales', 'topInasistencias'));
    }
}
