<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    /**
     * Mostrar la vista de Gestión de Unidades (Jefe).
     */
    public function index()
    {
        // resources/views/Jefe/IndexUnidades.blade.php
        return view('Jefe.IndexUnidades');
    }
}
