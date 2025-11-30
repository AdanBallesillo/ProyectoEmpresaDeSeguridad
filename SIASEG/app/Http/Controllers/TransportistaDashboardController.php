<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asistencia;
use App\Models\Viajes;

class TransportistaDashboardController extends Controller
{
    public function index()
    {
        $empleado = Auth::user();

        // Obtener asistencia
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

        // OBTENER VIAJE ACTIVO DEL TRANSPORTISTA (IGUAL QUE EN LA MODAL)
        $viaje = Viajes::where('empleado_id', $empleado->id_empleado)
    ->whereIn('estado', ['pendiente', 'en_curso'])
    ->with('ruta')
    ->first();

        return view('Transportistas.IndexTransportista', [
            'empleado' => $empleado,
            'asistencia' => $asistenciaHoy,
            'progreso' => $progreso,
            'viaje' => $viaje
        ]);
    }
}
