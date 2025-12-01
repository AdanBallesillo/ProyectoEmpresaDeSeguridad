<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;

class EmpleadoDashboardController extends Controller
{
    public function index()
    {
        $empleado = Auth::user();

        // Obtener asistencia del día actual
        $asistenciaHoy = Asistencia::where('empleado_id', $empleado->id_empleado)
            ->whereDate('fecha_registro', now()->toDateString())
            ->first();

        // Obtener estacion asignada
        $estacionAsignada = Asistencia::with('estacion')
            ->where('empleado_id', $empleado->id_empleado)
            ->first();


        // Calcular progreso
        $progreso = 0;
        if ($asistenciaHoy) {
            if ($asistenciaHoy->hora_entrada && !$asistenciaHoy->hora_salida) {
                $progreso = 50;
            } elseif ($asistenciaHoy->hora_entrada && $asistenciaHoy->hora_salida) {
                $progreso = 100;
            }
        }

        return view('Empleados.IndexEmpleados', [
            'empleado' => $empleado,
            'asistencia' => $asistenciaHoy,
            'estacion' => $estacionAsignada,
            'progreso' => $progreso,
        ]);
    }
}
