<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employed extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';
    public $incrementing = true;
    protected $keyType = 'int';
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
        'no_empleado',
        'password',
        // Modificacion
        'disponible',
        'status'
    ];

    /**
     * El campo que Laravel usará para login (username).
     * Aquí indicamos "no_empleado".
     */
    public function getAuthIdentifierName()
    {
        return 'no_empleado';
    }

    /**
     * Ocultar campos sensibles.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Casts automáticos.
     */
    protected $casts = [
        'password' => 'hashed',
    ];
}
