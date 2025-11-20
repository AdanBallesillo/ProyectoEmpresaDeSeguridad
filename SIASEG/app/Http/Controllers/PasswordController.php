<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{
    // Primero mostramos el formulario
    public function index() {
        return view ('Empleados.CambiarPassword');
    }

    // Recibimos y guardamos la contraseña
    public function ActualizarPassword(Request $request) {

        // Validamos la password que viene desde el formulario
        $request -> validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $empleado = Auth::user();
        $user -> update([
            'password' => Hash::make($request -> password),
            'cambiar_pass' => false
        ]);

        return redirect() -> route() -> with('success', 'Contraseña actualizada');
    }
}
