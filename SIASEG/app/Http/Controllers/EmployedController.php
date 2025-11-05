<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employed;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class EmployedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
        // Obtener todos los empleados de la tabla 'empleados'
        $empleados = Employed::all();

        // Retornar la vista y enviar los datos
        return view('Jefe.IndexPersonal', compact('empleados'));

        } catch (\Exception $e) {
            \Log::error('Error al obtener la lista de empleados: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al cargar la lista de empleados.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('crearempleado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Diccionario de mensajes personalizados
        $errorMessages = [
            'CURP.unique' => 'Error: esta CURP ya está registrada en la base de datos.',
            'RFC.unique' => 'Error: este RFC ya está registrado en la base de datos.',
            'correo.unique' => 'Error: este correo ya está registrado en la base de datos.',
            'required' => 'El campo :attribute es obligatorio.',
            'email' => 'El formato del correo electrónico no es válido.',
            'max' => 'El campo :attribute no puede tener más de :max caracteres.',
            'image' => 'El archivo subido debe ser una imagen válida (jpg, png, gif, etc).',
            'mimes' => 'El formato de la imagen debe ser jpg, jpeg, png o gif.',
        ];

        try{
            // Validar los datos del formulario
            $validated = $request->validate([
                'nombres' => 'required|string|max:100',
                'apellidos' => 'required|string|max:100',
                'CURP' => 'required|string|max:18|unique:empleados,CURP',
                'RFC' => 'required|string|max:13|unique:empleados,RFC',
                'telefono' => 'required|string|max:15',
                'fotografia' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
                'rol' => 'required|string|max:100',
                'correo' => 'required|email|max:150|unique:empleados,correo'
            ],  $errorMessages
            );

            // Generar num_control único
            do {
                $noEmpleado = rand(100000, 999999);
            } while (Employed::where('no_empleado', $noEmpleado)->exists());

            // Generar password aleatorio
            $passwordPlain = Str::random(8);
            $passwordHashed = Hash::make($passwordPlain);

            // Crear nuevo empleado
            $personal = new Employed();
            $personal->fill($validated);
            $personal->no_empleado = $noEmpleado;
            $personal->password = $passwordHashed;

            // Guardar fotografía si se sube
            if ($request->hasFile('fotografia')) {
                $image = $request->file('fotografia');

                // Generar nombre único
                $imageName = time() . '_' . $image->getClientOriginalName();

                // Guardar en storage/app/public/fotos la imagen
                $path = $image->storeAs('fotos', $imageName, 'public');

                // Guardar ruta accesible públicamente en public/storage/fotos con ayuda del link simbólico
                $personal->fotografia = 'storage/' . $path;
            }

            // Guardar registro en la base de datos
            $personal->save();

            // Retornar con datos útiles
            return redirect()->route('crearempleado')->with([
                'success' => 'Empleado registrado exitosamente.',
                'password' => $passwordPlain,
                'no_empleado' => $noEmpleado
            ]);
        } catch (ValidationException $e) {
            // Error de validación (regresa los mensajes)
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (QueryException $e) {
            // Error en base de datos
            Log::error('Error al guardar empleado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ocurrió un error al guardar los datos del empleado. Intenta de nuevo.')
                ->withInput();

        } catch (\Exception $e) {
            // Error general
            Log::error('Error inesperado: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Ha ocurrido un error inesperado. Contacta al administrador.')
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('mostrarempleados');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
