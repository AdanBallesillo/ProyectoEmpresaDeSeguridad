<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// Libreria para poder usar la autenticacion.
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employed extends Authenticatable
{
    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'CURP',
        'RFC',
        'telefono',
        'fotografia',
        'rol',
        'correo',
        // Nuevas columnas
        'no_empleado',
        'password',
        // Modificacion
        'disponible'
    ];


    // Le decimos a laravel que use el no_empleado para autenticar
    public function getAuthIdentifierName() {
        return 'no_empleado';
    }

    // Ocultamos la contraseña
    protected $hidden = [
        'password',
    ];
}
