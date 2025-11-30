<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardEstacionesController extends Controller
{
    public function index()
    {
        // Estaciones activas
        $estaciones = DB::table('estaciones')
            ->where('status', 'Activo')
            ->get();

        $hoy = Carbon::today();

        // Totales generales
        $totalEstaciones = $estaciones->count();

        $personalTotal = DB::table('empleados')
            ->where('status', 'Activo')
            ->where('rol', 'Empleado')   // o ->where('id_rol', 3) si usas ids
            ->count();


        $estacionesCompletas = 0;
        $estacionesFaltaPersonal = 0;

        // Preparamos estaciones para tarjetas y mapa
        $estacionesPreparadas = $estaciones->map(function ($estacion) use (&$estacionesCompletas, &$estacionesFaltaPersonal, $hoy) {

            // Personal requerido en esa estación
            $requerido = (int) ($estacion->p_requerido ?? 0);

            // 🔹 Contar asignaciones del día de hoy para esa estación
            $asignado = DB::table('asignaciones_turnos')
                ->where('id_estacion', $estacion->id_estacion)
                ->whereDate('fecha', $hoy)
                ->count();

            // Porcentaje para la barra
            $porcentaje = ($requerido > 0)
                ? min(100, round(($asignado / $requerido) * 100))
                : 0;

            // Clasificamos estado para los cuadros de resumen y el mapa
            if ($requerido == 0) {
                // No tiene personal requerido, la consideramos "completa" para no marcarla como problema
                $estadoPersonal = 'completa';
                $estacionesCompletas++;
            } elseif ($asignado <= 0) {
                $estadoPersonal = 'sin_personal';
                $estacionesFaltaPersonal++;
            } elseif ($asignado < $requerido) {
                $estadoPersonal = 'faltante';
                $estacionesFaltaPersonal++;
            } else {
                $estadoPersonal = 'completa';
                $estacionesCompletas++;
            }

            // Campos que usa la vista
            $estacion->personal_asignado    = $asignado;
            $estacion->porcentaje_ocupacion = $porcentaje;
            $estacion->estado_personal      = $estadoPersonal;

            return $estacion;
        });

        // Datos mínimos para el mapa
        $estacionesMapa = $estacionesPreparadas
            ->filter(function ($e) {
                return !is_null($e->latitud) && !is_null($e->longitud);
            })
            ->map(function ($e) {
                return [
                    'nombre'            => $e->nombre_estacion,
                    'lat'               => (float) $e->latitud,
                    'lng'               => (float) $e->longitud,
                    'ciudad'            => $e->ciudad,
                    'estado'            => $e->estado,
                    'tipo'              => $e->tipo,
                    'p_requerido'       => (int) ($e->p_requerido ?? 0),
                    'personal_asignado' => (int) ($e->personal_asignado ?? 0),
                    'estado_personal'   => $e->estado_personal,
                ];
            })
            ->values();

        return view('jefe.DashboardEstaciones', [
            'estaciones'              => $estacionesPreparadas,
            'totalEstaciones'         => $totalEstaciones,
            'personalTotal'           => $personalTotal,
            'estacionesCompletas'     => $estacionesCompletas,
            'estacionesFaltaPersonal' => $estacionesFaltaPersonal,
            'estacionesMapa'          => $estacionesMapa,
        ]);
    }
}
