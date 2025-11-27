<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estacion extends Model
{
    protected $table = 'estaciones';
    protected $primaryKey = 'id_estacion';
    public $timestamps = false; // usamos fecha_creacion / fecha_actualizacion de la BD

    protected $fillable = [
        'nombre_estacion',
        'estado',
        'ciudad',
        'colonia',
        'calle',
        'n_exterior',
        'p_requerido',
        'latitud',
        'longitud',
        'tipo',
        'descripcion',
        'status',
    ];
}
