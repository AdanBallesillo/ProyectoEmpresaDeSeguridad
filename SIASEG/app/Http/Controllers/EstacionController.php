<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estacion;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;


class EstacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Estacion::query();

            // Búsqueda por nombre o ciudad
            if ($request->filled('busqueda')) {
                $busqueda = $request->busqueda;
                $query->where(function ($q) use ($busqueda) {
                    $q->where('nombre_estacion', 'like', "%{$busqueda}%")
                        ->orWhere('ciudad', 'like', "%{$busqueda}%");
                });
            }

            $estaciones = $query->paginate(5);
            return view('Jefe.IndexEstaciones', compact('estaciones'));
        } catch (\Exception $e) {
            Log::error('Error al obtener estaciones: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar estaciones.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Jefe.CreateEstacion');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errorMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'in' => 'El valor seleccionado para :attribute no es válido.',
            'regex' => 'El formato de coordenadas es incorrecto. Debe ser lat,long (ej. 19.4326,-99.1332).'
        ];

        try {
            $validated = $request->validate([
                'nombre_estacion' => 'required|string|max:150',
                'estado' => 'required|string|max:100',
                'ciudad' => 'required|string|max:100',
                'colonia' => 'required|string|max:100',
                'calle' => 'required|string|max:150',
                'n_exterior' => 'required|string|max:20',
                'p_requerido' => 'required|numeric|min:0',
                'codigo_estacion' => 'required|string|max:6|unique:estaciones,codigo_estacion',
                'tipo' => 'required|in:Estacion,Zona',
                'descripcion' => 'nullable|string|max:250',
                'coordenadas' => ['required', 'regex:/^-?\d{1,3}\.\d+,\s*-?\d{1,3}\.\d+$/']
            ], $errorMessages);

            // Procesar coordenadas usando método separado
            [$lat, $lng] = $this->procesarCoordenadas($validated['coordenadas']);

            $estacion = new Estacion();
            $estacion->fill($validated);
            $estacion->latitud = $lat;
            $estacion->longitud = $lng;
            $estacion->save();

            return redirect()->route('estaciones.create')->with('success', 'Estación creada correctamente.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (QueryException $e) {
            Log::error('Error al guardar estación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al guardar la estación.')->withInput();
        } catch (\Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error inesperado. Contacta al administrador.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $estacion = Estacion::findOrFail($id);
            return view('Jefe.EditEstacion', compact('estacion'));
        } catch (\Exception $e) {
            Log::error('Error al cargar estación para edición: ' . $e->getMessage());
            // descomentar la siguiente linea cuando se tenga la ruta de index
            // return redirect()->route('estaciones.index')->with('error', 'No se pudo cargar la estación.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $errorMessages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'in' => 'El valor seleccionado para :attribute no es válido.',
            'regex' => 'El formato de coordenadas es incorrecto. Debe ser lat,long (ej. 19.4326,-99.1332).'
        ];

        try {
            $estacion = Estacion::findOrFail($id);

            $validated = $request->validate([
                'nombre_estacion' => 'string|max:150',
                'estado' => 'string|max:100',
                'ciudad' => 'string|max:100',
                'colonia' => 'string|max:100',
                'calle' => 'string|max:150',
                'n_exterior' => 'string|max:20',
                'p_requerido' => 'numeric|min:0',
                'codigo_estacion' => 'string|max:6|unique:estaciones,codigo_estacion,' . $id . ',id_estacion',
                'tipo' => 'in:Estacion,Zona',
                'descripcion' => 'nullable|string|max:250',
                'coordenadas' => ['regex:/^-?\d{1,3}\.\d+,\s*-?\d{1,3}\.\d+$/']
            ], $errorMessages);

            if (isset($validated['coordenadas'])) {
                [$lat, $lng] = $this->procesarCoordenadas($validated['coordenadas']);
                $estacion->latitud = $lat;
                $estacion->longitud = $lng;
            }

            $estacion->fill($validated);
            $estacion->save();

            return redirect()->back()->with('success', 'Estación actualizada correctamente.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Error al actualizar estación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo actualizar la estación.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

     /**
     * Método privado para procesar coordenadas
     */
    private function procesarCoordenadas(string $coords): array
    {
        [$lat, $lng] = array_map('trim', explode(',', $coords));
        return [(float)$lat, (float)$lng];
    }
}
