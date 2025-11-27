<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asistencia;

class TransportistaDashboardController extends Controller
{
    public function index()
    {
        $empleado = Auth::user();

        // Obtener la asistencia del día
        $asistenciaHoy = Asistencia::where('empleado_id', $empleado->id_empleado)
            ->whereDate('fecha_registro', now()->toDateString())
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

        return view('Transportistas.IndexTransportista', [
            'empleado' => $empleado,
            'asistencia' => $asistenciaHoy,
            'progreso' => $progreso
        ]);
    }
}
