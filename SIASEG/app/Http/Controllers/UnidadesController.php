<?php

namespace App\Http\Controllers;

use App\Models\Transporte;
use App\Models\Viajes;

class UnidadesController extends Controller
{
    public function index()
    {
        // Contar las unidades por estado
        $activos = Transporte::where('status', 'Activo')->count();
        $mantenimientos = Transporte::where('status', 'En mantenimiento')->count();

        // Total (solo activos + mantenimiento)
        $total = $activos + $mantenimientos;

        // Últimas unidades registradas para mostrar actividad
        $unidades = Transporte::orderBy('fecha_actualizacion', 'desc')->take(10)->get();

        // Nueva consulta
        $actividadUnidades = Viajes::with(['transporte', 'empleado', 'ruta'])
            -> whereIn('estado', ['en_curso', 'pendiente'])
            -> orderBy('fecha_programada', 'desc')
            -> get();

        return view('Jefe.IndexUnidades', compact('activos', 'mantenimientos', 'total', 'unidades', 'actividadUnidades'));
    }
}
