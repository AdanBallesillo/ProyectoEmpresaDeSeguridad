<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CambiarPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Primero se tiene que obtener el usuario logeado en el sistema
        $empleado = Auth::user();

        // Luego tenemos que consultar la columna de cambiar_pass
        if ($empleado && $empleado -> cambiar_pass) {

            // Despues si se cumple la condicion lo mandamos al formulario para que cambie la contraseña
            if ($request->routeIs(['primer-login.index', 'primer-login.update'])) {
                return $next($request);
            }
            // Por seguridad si se quiere saltar la validacion lo mandamos otra vez para donde mismo
            return redirect()->route('primer-login.index')
                ->with('warning', 'Por seguridad, debes cambiar la contraseña.');
        }
        // Y pos si no se cumple ninguna condicion lo dejamos pasar
        return $next($request);
    }
}
