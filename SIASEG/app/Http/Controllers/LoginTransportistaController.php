<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginTransportistaController extends Controller
{
    public function Index()
    {
        return view('Transportistas.IndexLoginTransportistas');
    }

    public function Validate(Request $request){

    if(Auth::attempt([
        'no_empleado' => $request->no_empleado,
        'password' => $request->password
    ])){

        //  Validar si debe cambiar la contraseña (primer inicio)
        if (Auth::user()->cambiar_pass == 1) {
            return redirect()->route('primer-login.index');
        }

        // Si ya cambió la contraseña, va a asistencia
        return redirect()->route('asistencia.verificarT');

    } else {
        return back()->withErrors([
            'login_error' => 'Usuario o contraseña incorrectos'
        ]);
    }
    }

    public function Logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('Transportista.Login');
    }
}
