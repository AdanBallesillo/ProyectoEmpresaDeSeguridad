<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class PasswordController extends Controller
{

    // Funcion para mandar a la vista donde se va a cambiar la contraseña
    public function index () {
        return view('Empleados.CambiarPassword');
    }


    // Funcion que va a validar y cambiar la contraseña
    public function ActualizarPassword(Request $request)
    {
        // Primero validamos la contraseña
        $request->validate([
            'password' => 'required|confirmed|min:8',
            // 'confirmed' busca un campo llamado password_confirmation
        ]);

        // Obtenemos que esta ha iniciado sesion
        $empleado = Auth::user();

        // Recibimos la contraseña y la encriptamos y ponemos en 0 la columna de cambiar_pass
        $empleado->password = Hash::make($request->password);
        $empleado->cambiar_pass = 0;

        // Guardamos los datos
        $empleado->save();

        // Dependiendo el rol lo mandamos hacia donde corresponde el rol
        switch ($empleado -> rol) {

            case 'Administrador':
                return redirect() -> route('jefe.unidades')
                    ->with('success', '¡Contraseña actualizada correctamente!');
                break;

            case 'Empleado':
                return redirect() -> route('asistencia.verificarE') 
                    ->with('success', '¡Contraseña actualizada correctamente!');
                break;
            case 'Secretaria':
                return redirect() -> route('Secretaria.Dashboard')
                    ->with('success', '¡Contraseña actualizada correctamente!');
                break;
            case 'Transportista':
                return redirect() -> route('asistencia.verificarT')
                    ->with('success', '¡Contraseña actualizada correctamente!');
                break;
            default:
                return with('Error', 'A ocurrido un error');
                break;
        }
    }
}
