<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transporte;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class TransporteController extends Controller
{
    /**
     * Mostrar formulario para crear nueva unidad.
     */
    public function create()
    {
        return view('Jefe.CreateUniadades');
    }

    /**
     * Guardar una nueva unidad en la base de datos.
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
            // Validar los datos
            $validated = $request->validate([
                'tipo' => 'required|string|max:50',
                'marca' => 'required|string|max:50',
                'modelo' => 'required|string|max:50',
                'anio' => 'required|digits:4|integer',
                'placas' => 'required|string|max:15|unique:transportes,placas',
                'numero_serie' => 'required|string|max:50|unique:transportes,numero_serie',
                'capacidad_carga' => 'nullable|numeric',
                'fecha_adquisicion' => 'nullable|date',
                'status' => 'nullable|in:Activo,En mantenimiento,Baja',
                'comentarios' => 'nullable|string|max:255'
            ], $mensajes);

            // Generar ID único
            do {
                $idTransporte = rand(1000, 9999);
            } while (Transporte::where('id_transporte', $idTransporte)->exists());

            // Crear nuevo registro
            $unidad = new Transporte();
            $unidad->fill($validated);
            $unidad->id_transporte = $idTransporte;
            $unidad->fecha_creacion = now();
            $unidad->fecha_actualizacion = now();
            $unidad->save();

            return redirect()->route('nuevasunidades')->with([
                'success' => 'Unidad registrada correctamente.',
                'id_transporte' => $idTransporte
            ]);

        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (QueryException $e) {
            Log::error('Error al guardar unidad: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ocurrió un error al guardar la unidad. Intente de nuevo.')
                ->withInput();

        } catch (\Exception $e) {
            Log::error('Error inesperado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ha ocurrido un error inesperado. Contacte al administrador.')
                ->withInput();
        }
    }
}
