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
        $empleado = Auth::user();

        // 1. CORREGIDO: Usamos 'cambiar_pass' que es el nombre real que salió en el debug
        if ($empleado && $empleado->cambiar_pass) {

            // 2. IMPORTANTE: Asegúrate que estos nombres ('primer-login.index')
            // sean EXACTAMENTE los que pusiste en tu archivo web.php en ->name(...)
            if ($request->routeIs(['primer-login.index', 'primer-login.update'])) {
                return $next($request);
            }

            return redirect()->route('primer-login.index')
                ->with('warning', 'Por seguridad, debes cambiar la contraseña.');
        }

        return $next($request);
    }
}
