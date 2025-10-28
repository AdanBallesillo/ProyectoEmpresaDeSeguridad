<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployedController;
use App\Http\Controllers\LoginAdministradorController;
use App\Http\Controllers\LoginSecretariaController;
use App\http\Controllers\LoginTransportistaController;



/*------------------------------------------------
RUTA RAIZ PARA QUE INICIEN LOS LOGIN
--------------------------------------------------
*/

Route::get('/', function () {
    return view('Empleados.IndexLoginEmpleados');
});

/*------------------------------------------------
RUTAS PARA EL CRUD DE USUARIOS
--------------------------------------------------
*/

Route::get('/Nuevo-Empleado', function () {
    return view('CreatePersonal');
})->name('crearempleado');

Route::post(
    '/empleados',
    [EmployedController::class, 'store']
)->name('employed.store');


/*------------------------------------------------
RUTAS PARA EL MENÚ DE LOS LOGIN
--------------------------------------------------
*/
Route::get('/LoginAdministrador/View', function () {
    return view('Jefe.IndexLoginJefe');
})->name('Ruta.LoginAdmin');

Route::get('/LoginEmpleados/View', function () {
    return view('Empleados.IndexLoginEmpleados');
})->name('Ruta.LoginEmpleado');

Route::get('/LoginSecretaria/View', function () {
    return view('Secretaria.IndexLoginSecretaria');
})->name('Ruta.LoginSecretaria');

Route::get('/LoginTransportista/View', function () {
    return view('Transportistas.IndexLoginTransportistas');
})->name('Ruta.LoginTranspo');


/*------------------------------------------------
RUTAS PARA EL LOGIN DE ADMINISTRADOR
--------------------------------------------------
*/

// Ruta para abrir el login de administrador
Route::get('/LoginAdministrador', [LoginAdministradorController::class, 'Index'])->name('Administrador.Login');

// Ruta para validar los datos
Route::post('/Administrador/Validate', [LoginAdministradorController::class, 'Validate'])->name('Administrador.Validate');

// Ruta para mostrar el dashboard o menú, protegido por el middleware
Route::get('/Administrador/Menu', function () {
    return view('CreatePersonal');
})->middleware('checkrol:Administrador')->name('Administrador.Dashboard');

// Ruta para cerrar sesion
Route::post('/Administrador/Logout', [LoginAdministradorController::class, 'Logout'])->name('Administrador.Logout');


/*------------------------------------------------
RUTAS PARA EL LOGIN DE TRANSPORTISTA
--------------------------------------------------
*/

// Ruta para abrir el login de Transportista
Route::get('/LoginTransportista', [LoginTransportistaController::class, 'Index'])->name('Transportista.Login');

// Ruta para validar los datos
Route::post('/Transportista/Validate', [LoginTransportistaController::class, 'Validate'])->name('Transportista.Validate');

// Ruta para mostrar el dashboard o menú, protegido por el middleware
Route::get('/Trasportista/Menu', function () {
    return view('IndexLoginEmpleados');
})->middleware('checkrol:Transportista')->name('Transportista.Menu');

// Ruta para cerrar sesion
Route::post('/Transportista/Logout', [LoginTransportistaController::class, 'Logout'])->name('Transportista.Logout');

/*------------------------------------------------
RUTAS PARA EL LOGIN DE SECRETARIA
--------------------------------------------------
*/


// Ruta para abrir el login de Secretaria
Route::get('/LoginSecretaria', [LoginSecretariaController::class, 'Index'])->name('Secretaria.Login');

// Ruta para validar los datos
Route::post('/Secretaria/Validate', [LoginSecretariaController::class, 'Validate'])->name('Secretaria.Validate');

// Ruta para mostrar el dashboard o menú, protegido por el middleware
Route::get('/Secretaria/Menu', function () {
    return view('CreatePersonal');
})->middleware('checkrol:Secretaria')->name('Secretaria.Dashboard');

// Ruta para cerrar sesion
Route::post('/Secretaria/Logout', [LoginSecretariaController::class, 'Logout'])->name('Secretaria.Logout');

/*------------------------------------------------
RUTAS PARA EL LOGIN DE EMPLEADOS
--------------------------------------------------*/

// Ruta para abrir el Login del Empleado
Route::get('/LoginEmpleado', [LoginEmpleadoController::class, 'Index']) -> name('Empleado.Login');

// Ruta para validar los datos
Route::post('/Empleado/Validate', [LoginTransportistaController::class, 'Validate']) -> name('Empleado.Validate');

// Ruta para mostrar el dashboard o menú, protegido por el middleware
Route::get('/Empleado/Menu', function () {
    return view ('IndexLoginEmpleados');
}) -> middleware('checkrol:Empleado') -> name('Empleado.Menu');

// Ruta para cerrar sesion
Route::post('/Empleado/Logout', [LoginTransportistaController::class, 'Logout']) -> name('Empleado.Logout');
