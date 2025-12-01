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
        'fecha_registro',
        'fecha_actualizacion',
        'foto_entrada',
        'foto_salida',
        'hora_entrada',
        'hora_salida'
    ];


    public function estacion()
    {
        return $this->belongsTo(\App\Models\Estacion::class, 'estacion_id', 'id_estacion');
    }
}
