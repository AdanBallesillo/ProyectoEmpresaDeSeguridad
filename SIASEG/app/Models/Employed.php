<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employed extends Model
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
        'correo'
    ];
}
