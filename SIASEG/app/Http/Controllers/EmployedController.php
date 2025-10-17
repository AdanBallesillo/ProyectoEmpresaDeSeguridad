<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employed;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crearempleado');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
        ]);

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

            // Guardar en storage/app/public/fotos
            $path = $image->storeAs('fotos', $imageName, 'public');

            // Guardar ruta accesible públicamente
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
