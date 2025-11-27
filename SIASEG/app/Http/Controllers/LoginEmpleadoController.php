<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginEmpleadoController extends Controller
{
    public function Index(){
        return view('Empleados.IndexLoginEmpleados');
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
        return redirect()->route('asistencia.verificarE');

    } else {
        return back()->withErrors([
            'login_error' => 'Usuario o contraseña incorrectos'
        ]);
    }
}

    public function Logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('Empleado.Login');
    }
}
