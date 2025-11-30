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
use App\Http\Controllers\ViajesController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\EmpleadoDashboardController;
use App\Http\Controllers\TransportistaDashboardController;
use App\Http\Controllers\DashboardEstacionesController;
use App\Http\Controllers\DashboardReportesController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\ReporteController;


/*------------------------------------------------
RUTA RAIZ PARA QUE INICIEN LOS LOGIN
--------------------------------------------------
*/

Route::get('/', function () {
    return view('Empleados.IndexLoginEmpleados');
})->name('login');

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


// Esta ruta sirve para mostrar el PDF, aun sin exportar.
Route::get('empleados/pdf', [EmployedController::class, 'generatePDF'])->name('empleados.pdf');

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
})->middleware('checkrol:Transportista, Administrador', 'cambiar.pass')->name('Transportistas.Menu');

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
Route::get('/Empleado/Menu', [EmpleadoDashboardController::class, 'index'])
    ->middleware(['checkrol:Administrador,Empleado', 'cambiar.pass'])
    ->name('Empleado.Menu');

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
    ->name('jefe.unidades');

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


/*--------------------------------------------
RUTAS PARA DASHBOARD REPORTES
--------------------------------------------*/

Route::get('/reportes', [DashboardReportesController::class, 'asistencia'])
    ->name('reportes.index');

Route::get('/reportes/pdf/{periodo}', [ReporteController::class, 'generarPDF'])
    ->name('reportes.pdf');

Route::get('/reportes/excel/{periodo}', [ReporteController::class, 'generarExcel'])
    ->name('reportes.excel');





///// Welcome ///////
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');


use App\Mail\CredencialesEmpleadoMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

Route::get('/test-mail', function () {
    Mail::to('nonatan_guerrero@hotmail.com')
        ->send(new CredencialesEmpleadoMail('Prueba', '123456', 'abc12345'));

    return 'Correo enviado (si no hay error en logs).';
});


/*--------------------------------------------
RUTAS PARA EL CAMBIO DE CONTRASEÑA
--------------------------------------------*/

Route::get('/cambiarPassword', [PasswordController::class, 'index'])
    ->name('primer-login.index')->middleware('auth');

Route::post('/cambiarPassword', [PasswordController::class, 'ActualizarPassword'])
    ->name('primer-login.update')->middleware('auth');




/*--------------------------------------------
RUTAS PARA LAS RUTAS DE TRANSPORTE
--------------------------------------------*/

Route::get('/rutas/index', [RutasController::class, 'index'])->name('rutas.index');
Route::get('/rutas/create', [RutasController::class, 'create'])->name('rutas.create');
Route::post('/rutas/store', [RutasController::class, 'store'])->name('rutas.store');
Route::get('rutas/{id}/edit', [RutasController::class, 'edit'])->name('rutas.edit');
Route::put('/rutas/{id}', [RutasController::class, 'update'])->name('rutas.update');


/*--------------------------------------------
RUTAS PARA LOS VIAJES
--------------------------------------------*/

Route::get('/viajes/create', [ViajesController::class, 'create'])->name('viajes.create');
Route::post('/viajes/store', [ViajesController::class, 'store'])->name('viajes.store');
Route::get('/mi-ruta', [ViajesController::class, 'miRuta'])->name('viajes.iniciar');
Route::post('/viajes/{id}/iniciar', [ViajesController::class, 'iniciarViaje'])->name('viajes.inicio');
Route::post('/viaje/{id}/terminar', [ViajesController::class, 'terminarViaje'])->name('viajes.terminar');
Route::get('/viajes/index', [ViajesController::class, 'index'])->name('viajes.index');
Route::get('/viajes/{id}/edit', [ViajesController::class, 'edit'])->name('viajes.edit');
Route::put('/viajes/{id}', [ViajesController::class, 'update'])->name('viajes.update');

//RUTAS DASHBOARD ESTACIONES
// DASHBOARD ESTACIONES

Route::get('/jefe/estaciones', [DashboardEstacionesController::class, 'index'])
    ->name('jefe.estaciones.index');

// Página para crear nueva estación
Route::get('/jefe/estaciones/nueva', [EstacionController::class, 'create'])
    ->name('jefe.estaciones.create');

// Página para modificar estaciones
Route::get('/jefe/estaciones/modificar', [EstacionController::class, 'edit'])
    ->name('jefe.estaciones.edit');

Route::get('/jefe/asignar/{estacion}', [AsignacionController::class, 'create'])
    ->name('jefe.asignar.personal');

Route::post('/jefe/asignar', [AsignacionController::class, 'store'])
    ->name('asignaciones.store');
// Vista donde empieza el proceso de huella
Route::get('/asistencias/verificarT', function () {
    return view('Transportistas.IndexHuella');
})
->middleware('auth')
->name('asistencia.verificarT');

//empleado heulla
Route::get('/asistencias/verificarE', function () {
    return view('Empleados.IndexHuella');
})
->middleware('auth')
->name('asistencia.verificarE');

// Evaluar la huella
Route::post('/asistencias/verificar', [AsistenciaController::class, 'registrarHuella'])
    ->middleware('auth');

// VISTA DE LA CÁMARA
Route::get('/asistencias/camaraT', function () {
    return view('Transportistas.IndexVerificarIdentidadT'); // <<< CAMBIA ESTE NOMBRE SI ES NECESARIO
})
->middleware('auth')
->name('asistencia.camaraT');

// VISTA DE LA CÁMARA Employed
Route::get('/asistencias/camaraE', function () {
    return view('Empleados.IndexVerificarIdentidad'); // <<< CAMBIA ESTE NOMBRE SI ES NECESARIO
})
->middleware('auth')
->name('asistencia.camaraE');

// Guardar foto
Route::post('/asistencias/foto', [AsistenciaController::class, 'guardarFoto'])
    ->middleware('auth')
    ->name('asistencia.foto');
//Ruta menu de trasnportista
Route::get('/Transportista/Menu', [TransportistaDashboardController::class, 'index'])
    ->middleware(['checkrol:Administrador,Transportista', 'cambiar.pass'])
    ->name('Transportista.Menu');

Route::post('/asistencias/verificarE', [AsistenciaController::class, 'verificarEmpleado'])
    ->middleware('auth')
    ->name('asistencia.verificarE');

    Route::post('/asistencias/verificarT', [AsistenciaController::class, 'verificarTransportista'])
    ->middleware('auth')
    ->name('asistencia.verificarT');



