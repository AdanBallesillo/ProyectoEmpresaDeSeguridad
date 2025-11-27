<?php

namespace App\Http\Controllers;

use App\Models\Estacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class EstacionController extends Controller
{
    /**
     * LISTADO DE ESTACIONES
     */
    public function index(Request $request)
    {
        try {
            $query = Estacion::query();

            $busqueda = $request->input('busqueda');
            $status   = $request->input('status'); // Activo / Inactivo / null

            // 🔎 Búsqueda por varios campos
            if (!empty($busqueda)) {
                $query->where(function ($q) use ($busqueda) {
                    $q->where('nombre_estacion', 'like', "%{$busqueda}%")
                        ->orWhere('estado', 'like', "%{$busqueda}%")
                        ->orWhere('ciudad', 'like', "%{$busqueda}%")
                        ->orWhere('colonia', 'like', "%{$busqueda}%")
                        ->orWhere('calle', 'like', "%{$busqueda}%")
                        ->orWhere('n_exterior', 'like', "%{$busqueda}%")
                        ->orWhere('tipo', 'like', "%{$busqueda}%")
                        ->orWhere('descripcion', 'like', "%{$busqueda}%");
                });
            }

            // Filtro por status (Activo / Inactivo)
            if (!empty($status)) {
                $query->where('status', $status);
            }

            $estaciones = $query
                ->orderBy('nombre_estacion')
                ->paginate(5)
                ->appends($request->only('busqueda', 'status'));

            return view('Jefe.IndexEstaciones', compact('estaciones', 'busqueda', 'status'));
        } catch (\Exception $e) {
            Log::error('Error al obtener estaciones: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar estaciones.');
        }
    }


    /**
     * FORMULARIO DE CREACIÓN
     */
    public function create()
    {
        return view('Jefe.CreateEstacion');
    }

    /**
     * GUARDAR NUEVA ESTACIÓN
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max'      => 'El campo :attribute no puede tener más de :max caracteres.',
            'numeric'  => 'El campo :attribute debe ser numérico.',
            'integer'  => 'El campo :attribute debe ser un número entero.',
            'in'       => 'El valor seleccionado para :attribute no es válido.',
            'between'  => 'El campo :attribute debe estar entre :min y :max.',
        ];

        try {
            $data = $request->validate([
                'nombre_estacion' => 'required|string|max:50',
                'estado'          => 'required|string|max:100',
                'ciudad'          => 'required|string|max:100',
                'colonia'         => 'required|string|max:100',
                'calle'           => 'required|string|max:100',
                'n_exterior'      => 'required|integer|min:0',
                'p_requerido'     => 'required|integer|min:0',
                'latitud'         => 'required|numeric|between:-90,90',
                'longitud'        => 'required|numeric|between:-180,180',
                'tipo'            => 'required|in:Estacion,Zona',
                'descripcion'     => 'nullable|string',
                // si no mandas status desde el form, lo pondremos en Activo
                'status'          => 'nullable|in:Activo,Inactivo',
            ], $messages);

            // default status = Activo si vino vacío
            if (empty($data['status'])) {
                $data['status'] = 'Activo';
            }

            Estacion::create($data);

            return redirect()
                ->route('estaciones.index')
                ->with('success', 'Estación creada correctamente.');
        } catch (ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (QueryException $e) {
            Log::error('Error al guardar estación: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Ocurrió un error al guardar la estación.')
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error inesperado al guardar estación: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Error inesperado. Contacta al administrador.')
                ->withInput();
        }
    }

    /**
     * FORMULARIO DE EDICIÓN
     */
    public function edit($id)
    {
        try {
            $estacion = Estacion::findOrFail($id);
            return view('Jefe.EditEstacion', compact('estacion'));
        } catch (\Exception $e) {
            Log::error('Error al cargar estación para edición: ' . $e->getMessage());
            return redirect()
                ->route('estaciones.index')
                ->with('error', 'No se pudo cargar la estación.');
        }
    }

    /**
     * ACTUALIZAR ESTACIÓN
     */
    public function update(Request $request, $id)
    {
        $estacion = Estacion::findOrFail($id);

        $request->validate([
            'nombre_estacion' => 'required|string|max:150',
            'estado'          => 'required|string|max:100',
            'ciudad'          => 'required|string|max:100',
            'colonia'         => 'required|string|max:100',
            'calle'           => 'required|string|max:150',
            'n_exterior'      => 'required|string|max:20',
            'p_requerido'     => 'required|numeric|min:0',
            'tipo'            => 'required|in:Estacion,Zona',
            'descripcion'     => 'nullable|string|max:250',
            'latitud'         => 'required|numeric|between:-90,90',
            'longitud'        => 'required|numeric|between:-180,180',
            'status'          => 'required|in:Activo,Inactivo',
        ]);

        $estacion->update([
            'nombre_estacion' => $request->nombre_estacion,
            'estado'          => $request->estado,
            'ciudad'          => $request->ciudad,
            'colonia'         => $request->colonia,
            'calle'           => $request->calle,
            'n_exterior'      => $request->n_exterior,
            'p_requerido'     => $request->p_requerido,
            'tipo'            => $request->tipo,
            'descripcion'     => $request->descripcion,
            'latitud'         => $request->latitud,
            'longitud'        => $request->longitud,
            'status'          => $request->status,
        ]);

        return redirect('/estaciones/show')
            ->with('success', 'Estación actualizada correctamente.');
    }


    /**
     * ELIMINAR ESTACIÓN (si luego quieres usarlo)
     */
    public function destroy($id)
    {
        try {
            $estacion = Estacion::findOrFail($id);
            $estacion->delete();

            return redirect()
                ->route('estaciones.index')
                ->with('success', 'Estación eliminada correctamente.');
        } catch (\Exception $e) {
            Log::error('Error al eliminar estación: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'No se pudo eliminar la estación.');
        }
    }
}
