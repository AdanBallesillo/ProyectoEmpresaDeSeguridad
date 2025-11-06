<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
// Librería para usar la validación
use Illuminate\Support\Facades\Auth;

class RolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Validamos si ya inicio sesión o no
        if (!Auth::check()){
            // Mandamos un mensaje, se esta usando como si fuera un diccionario de python donde es así: [clave => valor].
            return redirect ('Jefe.IndexLoginJefe') -> withErrors(['login_error' => 'Se debe de iniciar sesión primero']);
        }

        // Primera versión para mostrar el error
        if (!in_array(Auth::user()->rol, $roles)){
            // Cerramos la sesión
            Auth::logout();
            return back() -> withErrors(['login_error' => 'No tienes los permisos para iniciar sesión.']);
        }

        // // Segunda versión para mostrar el error
        // if (!in_array(Auth::user()->rol, $roles)){
        //     // Cerramos la sesión
        //     abort(403, 'No tienes los permisos para acceder a esta página.');
        // }

        // Si su rol SÍ estaba en la lista, avanzamos.
        return $next($request);
    }
}
