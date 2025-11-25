<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;

class RutasController extends Controller
{
    // Funcion para mandar mostrar y filtrar datos en la busqueda y paginacion
    public function index (Request $request) {
        // Recibimos y guardamos la busqueda que llega desde el formulario
        $busqueda = $request -> input ('busqueda');

        // Hacemos la consulta y ponemos los filtros de busqueda
        $rutas = Ruta::query () -> when ($busqueda, function ($query, $busqueda) {
            return $query -> where ('nombre', 'like', "%{$busqueda}%")
            -> orWhere('origen', 'like', "%{$busqueda}%")
            -> orWhere('destino', 'like', "%{$busqueda}%");
        }) -> orderBy('id_ruta', 'desc')
        ->paginate(10);

        // Retornamos la vista y le pasamos los datos
        return view ('Jefe.IndexRutas', compact ('rutas'));
    }

    // Funcion para mostrar el formulario para crear una ruta
    public function create () {
        return view ('Jefe.CreateRutas');
    }

    // Funcion para guardar la nueva ruta en la base de datos
    public function store (Request $request) {
        // Validar los campos primero
        $request -> validate ([
            'nombre' => 'required|max:255',
            'origen' => 'required|max:255',
            'destino' => 'required|max:255'
        ]);


        // Guardamos los datos en la base de datos
        Ruta::create([
            'nombre' => $request -> nombre,
            'origen' => $request -> origen,
            'destino' => $request -> destino,
            'status' => 'Activo'
        ]);
    }

    public function edit ($id_ruta) {
        $ruta = Ruta::find ($id_ruta);

        return view ('Jefe.EditRutas', compact ('ruta'));
    }
}
