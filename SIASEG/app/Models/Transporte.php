<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporte extends Model
{
    use HasFactory;

    protected $table = 'transportes';
    protected $primaryKey = 'id_transporte';
    public $timestamps = false; 

    protected $fillable = [
        'id_transporte',
        'tipo',
        'marca',
        'modelo',
        'anio',
        'placas',
        'numero_serie',
        'capacidad_carga',
        'fecha_adquisicion',
        'status',
        'comentarios'
    ];
}
