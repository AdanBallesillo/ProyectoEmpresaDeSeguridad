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
        return redirect() -> route('viajes.index');
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
            return redirect() -> route('viajes.iniciar');
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

    public function edit ($id_viaje) {

        // Traer toda la informacion usando el id
        $viaje = Viajes::find($id_viaje);

        // Vallidamos que no deje editar si esta finalizado el viaje
        if ($viaje -> estado == 'finalizado') {
            return back() -> with('error', 'No se puede editar un viaje ya finalizado');
        }

        // Cargar los choferes que estan disponibles o el actual
        $choferes = Employed::where('disponible', 1)
            -> where('status', 'Activo')
            -> orWhere('id_empleado', $viaje -> empleado_id)
            -> get();

        // Cargar las unidades disponibles o la actual
        $unidades = Transporte::where('disponible', 1)
            -> where ('status', 'Activo')
            -> orWhere('id_transporte', $viaje -> transportista_id)
            -> get();

        // Cargamos todas las rutas
        $rutas = Ruta::where('status', 'Activo') -> get();

        // Mandamos toda la informacion al formulario de editar
        return view ('Jefe.EditViajes', compact ('viaje', 'choferes', 'unidades', 'rutas'));
    }

    public function update (Request $request, $id_viaje) {

    // 1. Validaciones
    $request->validate([
        'id_empleado'      => 'required',
        'id_transporte'    => 'required',
        'id_ruta'          => 'required',
        'fecha_programada' => 'required|date',
        'estado'           => 'required'
    ]);

    $viaje = Viajes::find($id_viaje);

    try {
        DB::transaction(function () use ($request, $viaje) {

            // =======================================================
            // LÓGICA DE CAMBIO DE CHOFER
            // =======================================================
            if($request->id_empleado != $viaje->empleado_id) {

                // 1. Liberar al chofer VIEJO
                $choferViejo = Employed::find($viaje->empleado_id);
                if ($choferViejo) {
                    $choferViejo->disponible = 1; // Libre
                    $choferViejo->save();
                }

                // 2. Ocupar al chofer NUEVO
                // ¡CORRECCIÓN AQUÍ! Usamos $request->id_empleado
                $choferNuevo = Employed::find($request->id_empleado);

                // Validar disponibilidad
                if ($choferNuevo->disponible == 0) {
                    throw new \Exception("El chofer seleccionado ya no está disponible.");
                }

                $choferNuevo->disponible = 0; // Ocupado
                $choferNuevo->save();
            }

            // =======================================================
            // LÓGICA DE CAMBIO DE UNIDAD
            // =======================================================
            // Verifica si en tu modelo es 'transportista_id' o 'transporte_id'
            if ($request->id_transporte != $viaje->transportista_id) {

                // 1. Liberar unidad VIEJA
                $unidadVieja = Transporte::find($viaje->transportista_id);

                // ¡CORRECCIÓN AQUÍ! (Typo: $unidadVIeja -> $unidadVieja)
                if ($unidadVieja) {
                    $unidadVieja->disponible = 1;
                    $unidadVieja->save();
                }

                // 2. Ocupar unidad NUEVA
                $unidadNueva = Transporte::find($request->id_transporte);

                if ($unidadNueva->disponible == 0) {
                    throw new \Exception("La unidad seleccionada ya no está disponible.");
                }

                $unidadNueva->disponible = 0;
                $unidadNueva->save();
            }

            // =======================================================
            // LÓGICA DE CANCELACIÓN
            // =======================================================
            if ($request->estado == 'cancelado' && $viaje->estado != 'cancelado') {
                // Forzamos la liberación de ambos
                // Asegúrate que el modelo sea Transporte (singular)
                $emp = Employed::find($request->id_empleado);
                if($emp) { $emp->disponible = 1; $emp->save(); }

                $trans = Transporte::find($request->id_transporte);
                if($trans) { $trans->disponible = 1; $trans->save(); }
            }

            // =======================================================
            // GUARDAR CAMBIOS EN EL VIAJE (Manual para seguridad)
            // =======================================================
            $viaje->empleado_id      = $request->id_empleado;
            $viaje->transportista_id = $request->id_transporte; // Nombre exacto de la columna
            $viaje->ruta_id          = $request->id_ruta;
            $viaje->fecha_programada = $request->fecha_programada;
            $viaje->estado           = $request->estado;

            $viaje->save(); // ¡Guardar!
        });

        return redirect()->route('viajes.index')->with('success', 'Viaje actualizado correctamente');

    } catch (\Throwable $th) {
        // Este mensaje te dirá exactamente qué pasó si vuelve a fallar
        return back()->with('error', 'Error: ' . $th->getMessage());
    }
}
}
