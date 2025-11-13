<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transporte;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class TransporteController extends Controller
{
    /**
     * Listado de unidades
     */
    public function showUnidades(Request $request)
    {
        try {
            $query = Transporte::query();

            if ($request->filled('busqueda')) {
                $busqueda = $request->busqueda;

                $query->where(function ($q) use ($busqueda) {
                    $q->where('tipo', 'like', "%{$busqueda}%")
                        ->orWhere('marca', 'like', "%{$busqueda}%")
                        ->orWhere('modelo', 'like', "%{$busqueda}%")
                        ->orWhere('placas', 'like', "%{$busqueda}%")
                        ->orWhere('numero_serie', 'like', "%{$busqueda}%")
                        ->orWhere('status', 'like', "%{$busqueda}%");
                });
            }

            // Puedes usar paginate si quieres paginación
            $unidades = $query->paginate(8);

            return view('Jefe.ShowUnidades', compact('unidades'));
        } catch (\Exception $e) {
            Log::error('Error al obtener unidades de transporte: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al cargar la lista de unidades.');
        }
    }

    /**
     * FORMULARIO NUEVA UNIDAD
     * Ruta: GET /nuevasunidades
     */
    public function create()
    {
        // Asegúrate que el nombre coincide exactamente con tu vista:
        // resources/views/Jefe/CreateUniadades.blade.php
        return view('Jefe.CreateUniadades');
    }

    /**
     * GUARDAR nueva unidad
     * Ruta: POST /nuevasunidades
     */
    public function store(Request $request)
    {
        $mensajes = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'in' => 'El campo :attribute debe ser uno de los siguientes valores: :values.',
            'unique' => 'El valor del campo :attribute ya existe en la base de datos.'
        ];

        try {
            $validated = $request->validate([
                'tipo'             => 'required|string|max:50',
                'marca'            => 'required|string|max:50',
                'modelo'           => 'required|string|max:50',
                'anio'             => 'required|digits:4|integer',
                'placas'           => 'required|string|max:15|unique:transportes,placas',
                'numero_serie'     => 'required|string|max:50|unique:transportes,numero_serie',
                'capacidad_carga'  => 'nullable|numeric',
                'fecha_adquisicion' => 'nullable|date',
                'status'           => 'nullable|in:Activo,En mantenimiento,Baja',
                'comentarios'      => 'nullable|string|max:255'
            ], $mensajes);

            $unidad = new Transporte();
            $unidad->fill($validated);
            $unidad->fecha_creacion      = now();
            $unidad->fecha_actualizacion = now();
            $unidad->save();

            return redirect()->route('jefe.unidades')
                ->with('success', 'Unidad registrada correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            Log::error('Error al guardar unidad: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al guardar la unidad.')->withInput();
        }
    }

    /**
     * EDITAR una unidad
     */
    public function edit($id)
    {
        $unidad = Transporte::findOrFail($id);
        return view('Jefe.EditUnidades', compact('unidad'));
    }

    /**
     * ACTUALIZAR una unidad
     */
    public function update(Request $request, $id)
    {
        $mensajes = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'numeric' => 'El campo :attribute debe ser numérico.',
            'in' => 'El campo :attribute debe ser uno de los siguientes valores: :values.',
            'unique' => 'El valor del campo :attribute ya existe en la base de datos.'
        ];

        try {
            $unidad = Transporte::findOrFail($id);

            $validated = $request->validate([
                'tipo' => 'string|max:50',
                'marca' => 'string|max:50',
                'modelo' => 'string|max:50',
                'anio' => 'digits:4|integer',

                'placas' => [
                    'string',
                    'max:15',
                    Rule::unique('transportes', 'placas')->ignore($id, 'id_transporte'),
                ],

                'numero_serie' => [
                    'string',
                    'max:50',
                    Rule::unique('transportes', 'numero_serie')->ignore($id, 'id_transporte'),
                ],

                'capacidad_carga'  => 'nullable|numeric',
                'fecha_adquisicion' => 'nullable|date',
                'status'           => 'in:Activo,En mantenimiento,Baja',
                'comentarios'      => 'string|max:255',
            ], $mensajes);

            $unidad->fill($validated);
            $unidad->fecha_actualizacion = now();
            $unidad->save();

            return redirect()
                ->route('unidades.edit', $id)
                ->with('success', 'Unidad actualizada correctamente.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }
    }
}
