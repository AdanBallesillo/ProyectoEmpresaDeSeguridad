<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployedController;

Route::get('/Nuevo-Empleado', function () {
    return view('CreatePersonal');
})->name('crearempleado');

Route::post('/empleados', 
[EmployedController::class, 'store'])->name('employed.store');

