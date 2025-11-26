<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    protected $primaryKey = 'id_asistencia';
    public $timestamps = false;

    protected $fillable = [
        'empleado_id',
        'turno_id',
        'estacion_id',
        'status_asistencia',
        'STATUS',
        'fecha_registro',
        'fecha_actualizacion'
    ];
}
