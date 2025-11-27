<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
// Nueva modificacion
use App\Models\Estacion;

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

        // Para que carguen las rutas automaticamente vamos hacer una consulta
        $estaciones = Estacion::all();
        // Le pasamos la informacion al formulario
        return view ('Jefe.CreateRutas', compact('estaciones'));
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

        return redirect() -> route('rutas.index');
    }


    // Funcion para llevar los datos al formulario de editar rutas
    public function edit ($id_ruta) {
        $ruta = Ruta::find ($id_ruta);
        // Para que carguen las rutas automaticamente vamos hacer una consulta
        $estaciones = Estacion::all();
        // Le pasamos la informacion al formulario
        return view ('Jefe.EditRutas', compact ('ruta', 'estaciones'));
    }

    // Funcion para guardar la actualización de los datos
    public function update (Request $request, $id_ruta) {
        // Validamos los campos que llegan desde el formulario
        $request -> validate ([
            'nombre' => 'required|max:255',
            'origen' => 'required|max:255',
            'destino' => 'required|max:255',
            'status' => 'required|in:Activo,Inactivo'
        ]);

        // Buscamos el registro que tenga ese id
        $ruta = Ruta::find($id_ruta);

        // Hacemos la actulización en la base de datos
        $ruta -> update ([
            'nombre' => $request -> nombre,
            'origen' => $request -> origen,
            'destino' => $request -> destino,
            'status' => $request -> status
        ]);

        return redirect () -> route('rutas.index');
    }


}
