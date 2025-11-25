<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployedController;
use App\Http\Controllers\LoginAdministradorController;
use App\Http\Controllers\LoginSecretariaController;
use App\Http\Controllers\LoginTransportistaController;
use App\Http\Controllers\LoginEmpleadoController;
use App\Http\Controllers\TransporteController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\EstacionController;
use App\Http\Controllers\RutasController;

/*------------------------------------------------
RUTA RAIZ PARA QUE INICIEN LOS LOGIN
--------------------------------------------------
*/

Route::get('/', function () {
    return view('Empleados.IndexLoginEmpleados');
}) -> name('login');

/*------------------------------------------------
RUTAS PARA EL CRUD DE USUARIOS
--------------------------------------------------
*/

// Rutas para crear usuarios
Route::get('/Empleados', [EmployedController::class, 'index'])->name('mostrarempleados');

// formulario nuevo empleado
Route::get('/Nuevo-Empleado', function () {
    return view('Jefe.CreatePersonal');
})->name('crearempleado');

// guardar empleado
Route::post('/Nuevo-Empleado', [EmployedController::class, 'store'])->name('empleados.store');

// Rutas para mostrar los usuarios
Route::get(
    '/empleados/show',
    [EmployedController::class, 'index']
)->name('mostrarempleados');

// Rutas para modificar usuarios como jefe
Route::get(
    '/empleados/{id}/edit',
    [EmployedController::class, 'edit']
)->name('modificarempleadojefe');

Route::put(
    '/Editar-Empleado/{id}',
    [EmployedController::class, 'update']
)->name('empleados.update');

/*------------------------------------------------
RUTAS PARA EL MENÚ DE LOS LOGIN
--------------------------------------------------
*/
Route::get('/Administrador', function () {
    return view('Jefe.IndexLoginJefe');
})->name('Ruta.LoginAdmin');

Route::get('/Empleados', function () {
    return view('Empleados.IndexLoginEmpleados');
})->name('Ruta.LoginEmpleado');

Route::get('/Secretaria', function () {
    return view('Secretaria.IndexLoginSecretaria');
})->name('Ruta.LoginSecretaria');

Route::get('/Transportista', function () {
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
    return view('Jefe.CreatePersonal');
});


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
Route::get('/Transportistas/Huella', function () {
    return view('Transportistas.IndexTransportista');
})->middleware('checkrol:Transportista, Administrador')->name('Transportistas.Menu');

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
Route::get('/Jefe/Menu', function () {
    return view('Secretaria.IndexDashboardSecretaria');
})->middleware('checkrol:Secretaria, Administrador')->name('Secretaria.Dashboard');


// Ruta para cerrar sesion
Route::post('/Secretaria/Logout', [LoginSecretariaController::class, 'Logout'])->name('Secretaria.Logout');


/*------------------------------------------------
RUTAS PARA EL LOGIN DE EMPLEADOS
--------------------------------------------------*/

// Ruta para abrir el Login del Empleado
Route::get('/LoginEmpleado', [LoginEmpleadoController::class, 'Index'])->name('Empleado.Login');

// Ruta para validar los datos
Route::post('/Empleado/Validate', [LoginEmpleadoController::class, 'Validate'])->name('Empleado.Validate');

// Ruta para mostrar el dashboard o menú, protegido por el middleware
Route::get('/Empleado/Menu', function () {
    return view('Empleados.IndexEmpleados');
})->middleware('checkrol:Administrador,Empleado', 'cambiar.pass') ->name('Empleado.Menu');

// Ruta para cerrar sesion
Route::post('/Empleado/Logout', [LoginEmpleadoController::class, 'Logout'])->name('Empleado.Logout');


/*--------------------------------------------
RUTAS PARA TRANSPORTE
--------------------------------------------*/

// Listado
Route::get('/unidades', [TransporteController::class, 'index'])
    ->name('mostrartodasunidades');

// Formulario crear
Route::get('/nuevasunidades', [TransporteController::class, 'create'])
    ->name('nuevasunidades');


/*--------------------------------------------
RUTAS PARA UNIDADES
--------------------------------------------*/

// DASHBOARD DEL JEFE
Route::get('/jefe/unidades', [UnidadesController::class, 'index'])
    ->name('jefe.unidades') -> middleware('checkrol:Administrador', 'cambiar.pass');

Route::get('/nuevasunidades', [TransporteController::class, 'create'])
    ->name('nuevasunidades');

Route::post('/nuevasunidades', [TransporteController::class, 'store'])
    ->name('unidades.store');

// Listar todas las unidades
// Esta ruta al parecer no sirve
Route::get('/unidades/show', [TransporteController::class, 'showUnidades'])
    ->name('mostrartodasunidades');

// Formulario para editar UNA unidad
Route::get('/unidades/{id}/editar', [TransporteController::class, 'edit'])
    ->name('unidades.edit');

// Guardar cambios de la unidad
Route::put('/unidades/{id}', [TransporteController::class, 'update'])
    ->name('unidades.update');


/*--------------------------------------------
RUTAS PARA ESTACIONES
--------------------------------------------*/

// Listado de estaciones
Route::get('/estaciones/show', [EstacionController::class, 'index'])->name('estaciones.index');

// Formulario para crear estación
Route::get('/estaciones/create', [EstacionController::class, 'create'])->name('estaciones.create');

// Guardar nueva estación (POST)
Route::post('/estaciones', [EstacionController::class, 'store'])->name('estaciones.store');

// Editar estación
Route::get('/estaciones/{id}/edit', [EstacionController::class, 'edit'])->name('estaciones.edit');

// Actualizar estación
Route::put('/estaciones/{id}', [EstacionController::class, 'update'])->name('estaciones.update');


///// Welcome ///////
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

use App\Mail\CredencialesEmpleadoMail;
use Illuminate\Support\Facades\Mail;



Route::get('/test-mail', function () {
    Mail::to('nonatan_guerrero@hotmail.com')
        ->send(new CredencialesEmpleadoMail('Prueba', '123456', 'abc12345'));

    return 'Correo enviado (si no hay error en logs).';
});

// Rutas para el cambio de contraseña
Route::get('/cambiarPassword', [PasswordController::class, 'index'])
    -> name ('primer-login.index') -> middleware('auth');

Route::post('/cambiarPassword', [PasswordController::class, 'ActualizarPassword'])
    -> name ('primer-login.update') -> middleware('auth');


// Rutas para crear nuevas rutas de transporte
Route::get('/rutas/index', [RutasController::class, 'index']) -> name ('rutas.index');
Route::get('/rutas/create', [RutasController::class, 'create']) -> name ('rutas.create');
Route::post('/rutas/store', [RutasController::class, 'store']) -> name ('rutas.store');
Route::get('rutas/{id}/edit', [RutasController::class, 'edit']) -> name ('rutas.edit');
Route::put('/rutas/{id}', [RutasController::class, 'update']) -> name ('rutas.update');
