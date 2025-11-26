<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employed;
use App\Models\Transporte;
use App\Models\Ruta;

class Viajes extends Model
{
    protected $table = 'viajes';

    protected $primaryKey = 'id_viaje';

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $fillable = [
        'empleado_id',
        'transportista_id',
        'ruta_id',
        'estado',
        'fecha_programada',
        'hora_inicio_real',
        'hora_fin_real'
    ];

    protected $cast = [
        'fecha_programada' => 'date',
        'hora_inicio_real' => 'datetime',
        'hora_fin_real' => 'datetime',
        'fecha_creacion' => 'datetime',
        'fecha_actualizacion' => 'datetime'
    ];

    // RELACIONES

    // Un viaje tiene un empleado
    public function empleado () {
        return $this -> belongsTo(Employed::class, 'empleado_id', 'id_empleado');
    }

    // Un viaje tiene un transporte
    public function transporte () {
        return $this -> belongsTo(Transporte::class, 'transportista_id', 'id_transporte');
    }

    // Un viaje tiene una ruta
    public function ruta () {
        return $this -> belongsTo(Ruta::class, 'ruta_id', 'id_ruta');
    }
}
