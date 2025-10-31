<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AsistenciasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('asistencias')->delete();
        
        \DB::table('asistencias')->insert(array (
            0 => 
            array (
                'id_asistencia' => 1,
                'empleado_id' => 1,
                'turno_id' => 1,
                'estacion_id' => 1,
                'zona_id' => NULL,
                'fecha_registro' => '2025-10-02 02:22:15',
                'status_asistencia' => 'Tarde',
                'STATUS' => 'Activo',
                'comentario' => 'Se retrasó 10 min [Registro marcado como inactivo]',
                'fecha_actualizacion' => '2025-10-02 02:23:46',
            ),
        ));
        
        
    }
}