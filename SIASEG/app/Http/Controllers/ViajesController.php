<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruta;
use App\Models\Employed;
use App\Models\Viajes;
use App\Models\Transporte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ViajesController extends Controller
{
    // Funcion para mostrar el formulario de asignacion
    public function create () {
        $transportistas = Employed::where('disponible', true) -> where('status', 'Activo') -> where('rol', 'Transportista') -> get();
        $unidades = Transporte::where('disponible', true) -> where('status', 'Activo') -> get();
        $rutas = Ruta::where('status', 'Activo') -> get();

        return view ('Jefe.CreateViajes', compact('transportistas', 'unidades', 'rutas'));
    }

    public function store (Request $request) {
        $request -> validate ([
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'id_transporte' => 'required|exists:transportes,id_transporte',
            'id_ruta' => 'required|exists:rutas,id_ruta',
            'fecha_programada' => 'required|date|after_or_equal:today'
        ]);

        //dd($request -> all());
        // Usamos las transacciones por si algo llega a salir mal
        DB::transaction(function () use ($request) {
            Viajes::create ([
                'empleado_id' => $request -> id_empleado,
                'transportista_id' => $request -> id_transporte,
                'ruta_id' => $request -> id_ruta,
                'fecha_programada' => $request -> fecha_programada,
                'estado' => 'pendiente'
            ]);

            $chofer = Employed::find($request -> id_empleado);
            $chofer -> update(['disponible' => 0]);
            $unidad = Transporte::find($request -> id_transporte);
            if ($unidad) {
                $unidad -> disponible = 0;
                $unidad -> save();
            }
        });
    }

    // Funcion para traer toda la información de la ruta
    public function miRuta () {

        $id_empleado = Auth::user() -> id_empleado;

        $viaje = Viajes::with('ruta') -> where ('empleado_id', $id_empleado) -> whereIn('estado', ['pendiente', 'en_curso']) -> first();

        return view ('Transportistas.IndexCard', compact('viaje'));
    }

    // Funcion para iniciar el viaje y quede registro en la base de datos
    public function iniciarViaje ($id_viaje) {
        // Buscamos el viaje por medio del id
        $viaje = Viajes::find($id_viaje);

        // Validamos si hay un viaje, para que no se vaya a romper algo
        if (!$viaje) {
            return back() -> with('error', 'Viaje no encontrado');
        }

        // Solo iniciamos el viaje si esta pendiente si no no
        if ($viaje -> estado = 'pendiente') {
            $viaje -> update ([
                'estado' => 'en_curso',
                'hora_inicio_real' => now()
            ]);

            // Falta poner los mensajes que no se te olvide wey
        }
    }

    public function terminarViaje ($id_viaje) {
        $viaje = Viajes::find($id_viaje);

        if(!$viaje) {
            return back() -> with('error', 'Viaje no encontrado');
        }

        if ($viaje -> estado == 'en_curso') {

            DB::transaction(function () use ($viaje) {
                $viaje -> update ([
                    'estado' => 'finalizado',
                    'hora_fin_real' => now()
                ]);

                if ($viaje -> empleado) {
                    $viaje -> empleado -> update(['disponible' => 1]);
                }

                if ($viaje -> transporte) {
                    $viaje -> transporte -> update(['disponible'=> 1]);
                }

            });
        }
    }

    // Funcion para mostrar todos los registros en el index
    public function index (Request $request) {

        $busqueda = $request -> get('busqueda');

        $viajes = Viajes::with(['empleado', 'transporte', 'ruta'])
            -> when($busqueda, function ($query) use ($busqueda) {
                return $query -> whereHas('empleado', function ($q) use ($busqueda) {
                    $q -> where ('nombres', 'like', "%$busqueda%")
                        -> orWhere('apellidos', 'like', "%$busqueda%");
                })
                -> orWhereHas('ruta', function ($q) use ($busqueda) {
                    $q -> where('nombre', 'like', "%$busqueda%");
                });
            })
            -> orderBy('fecha_programada', 'desc')
            -> paginate(10);
        return view ('Jefe.indexViajes', compact('viajes'));
    }
}
