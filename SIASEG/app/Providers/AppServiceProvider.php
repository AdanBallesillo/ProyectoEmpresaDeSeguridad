<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // Limitador para ADMINISTRADOR
    RateLimiter::for('admin-login', function (Request $request) {
        return Limit::perMinute(3)->by($request->ip())->response(function(Request $request, array $headers) {
            return redirect()
                ->route('Administrador.Login') // Ruta del login de admin
                ->withErrors(['login_error' => 'Demasiados intentos, Espere 1 minuto.'])
                ->withInput();
        });
    });

    // Limitador para EMPLEADO
    RateLimiter::for('empleado-login', function (Request $request) {
        return Limit::perMinute(3)->by($request->ip())->response(function(Request $request, array $headers) {
            return redirect()
                ->route('Empleado.Login') // Ruta del login de empleado
                ->withErrors(['login_error' => 'Demasiados intentos. Espere 1 minuto.'])
                ->withInput();
        });
    });

    // Limitador para TRANSPORTISTA
    RateLimiter::for('transportista-login', function (Request $request) {
        return Limit::perMinute(3)->by($request->ip())->response(function(Request $request, array $headers) {
            return redirect()
                ->route('Transportista.Login') // Ruta del login de transportista
                ->withErrors(['login_error' => 'Demasiados intentos. Espere 1 minuto.'])
                ->withInput();
        });
    });

    // Limitador para SECRETARIA
    RateLimiter::for('secretaria-login', function (Request $request) {
        return Limit::perMinute(3)->by($request->ip())->response(function(Request $request, array $headers) {
            return redirect()
                ->route('Secretaria.Login') // Ruta del login de secretaria
                ->withErrors(['login_error' => 'Demasiados intentos, Espere 1 minuto.'])
                ->withInput();
        });
    });
    }
}
