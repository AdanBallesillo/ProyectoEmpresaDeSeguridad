<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{
    public function index () {
        return view('Empleados.CambiarPassword');
    }

    // Procesa el cambio (POST)
    public function ActualizarPassword(Request $request)
    {
        // 1. Validamos que la contraseña sea segura y coincida con la confirmación
        $request->validate([
            'password' => 'required|confirmed|min:6',
            // 'confirmed' busca un campo llamado password_confirmation
        ]);

        // 2. Obtenemos al empleado actual
        $empleado = Auth::user();

        // 3. ACTUALIZAMOS LOS DATOS
        // Aquí es donde ocurre la magia:
        $empleado->password = Hash::make($request->password); // Encriptamos la nueva
        $empleado->cambiar_pass = 0; // <--- ¡AQUÍ ESTÁ LO QUE DECÍAS! (Quitamos la bandera)

        // 4. Guardamos en la base de datos
        $empleado->save();

        // 5. Redirigimos al Dashboard (o a donde deba ir según su rol)
        // Como ya pusimos cambiar_pass en 0, el middleware ahora sí lo dejará pasar.

        // Ojo: Redirige a la ruta que corresponda a su rol.
        // Si es jefe a su dashboard, si es empleado al suyo.
        return redirect()->route('Empleado.Menu')
            ->with('success', '¡Contraseña actualizada correctamente!');
    }
}
