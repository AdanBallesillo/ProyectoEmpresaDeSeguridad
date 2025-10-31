<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TurnosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('turnos')->delete();
        
        \DB::table('turnos')->insert(array (
            0 => 
            array (
                'id_turno' => 1,
                'nombre_turno' => 'Matutino Extendido',
                'hora_entrada' => '07:30:00',
                'hora_salida' => '16:30:00',
                'tolerancia_minutos' => 10,
                'fecha_creacion' => '2025-10-02 02:11:40',
                'fecha_actualizacion' => '2025-10-02 02:11:40',
                'status' => 'Activo',
            ),
        ));
        
        
    }
}