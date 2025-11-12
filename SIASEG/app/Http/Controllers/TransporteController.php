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
        // Asegúrate que la vista coincida con tu carpeta actual (por ejemplo: resources/views/Jefe/CreateUniadades.blade.php)
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
            'unique' => 'El valor del campo :attribute ya existe en la base de datos.',
            'digits' => 'El campo :attribute debe tener :digits dígitos.',
            'date' => 'El campo :attribute debe ser una fecha válida.'
        ];

        try {
            // Validar datos
            $validated = $request->validate([
                'tipo'             => 'required|string|max:50',
                'marca'            => 'required|string|max:50',
                'modelo'           => 'required|string|max:50',
                'anio'             => 'required|digits:4|integer',
                'placas'           => 'required|string|max:15|unique:transportes,placas',
                'numero_serie'     => 'required|string|max:50|unique:transportes,numero_serie',
                'capacidad_carga'  => 'nullable|numeric',
                'fecha_adquisicion' => 'nullable|date',
                'status'           => 'required|in:Activo,En mantenimiento,Baja',
                'comentarios'      => 'nullable|string|max:255',
            ], $mensajes);

            // Agregar campos de fecha automáticos
            $data = $validated + [
                'fecha_creacion'      => now(),
                'fecha_actualizacion' => now(),
            ];

            // Crear nuevo registro (sin generar ID manualmente)
            $unidad = Transporte::create($data);

            return redirect()
                ->route('nuevasunidades')
                ->with('success', 'Unidad registrada correctamente (ID: ' . $unidad->id_transporte . ').');
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
