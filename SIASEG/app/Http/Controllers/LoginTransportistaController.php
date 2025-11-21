<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Libreria para autenticacion.
use Illuminate\Support\Facades\Auth;

class LoginTransportistaController extends Controller
{
    // Función para mostrar el login de Transportista
    public function Index()
    {
        return view('Transportistas.IndexLoginTransportistas');
    }

    // Funcion para validar los datos
    public function Validate(Request $request)
    {

        //dd($request->all()); -> Sirve para ver como se estan mandando los datos

        // Hacemos la consulta a la base de datos y validamos
        if (Auth::attempt([
            'no_empleado' => $request->no_empleado,
            'password' => $request->password
        ])) {
            // Si son correctas las credenciales lo redireccionamos a su menú o dashboard
            return redirect()->route('Transportistas.Menu');
        } else {
            // Si no, le mostramos este mensaje.
            return back()->withErrors([
                'login_error' => 'Usuario o contraseña incorrectos'
            ]);
        }
    }

    // Funcion para cerrar la sesión
    public function Logout(Request $request)
    {
        // Cerramos la sesión
        Auth::logout();

        // Borramos los datos de la sesión.
        $request->session()->invalidate();
        // Cambiamos el token del formulario
        $request->session()->regenerateToken();

        return redirect()->route('Transportistas.Login');
    }
}
