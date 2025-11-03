<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MantenimientosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mantenimientos')->delete();
        
        \DB::table('mantenimientos')->insert(array (
            0 => 
            array (
                'id_mantenimiento' => 1,
                'transporte_id' => 1,
                'fecha_servicio' => '2025-09-20',
                'tipo_servicio' => 'Frenos y balatas',
                'descripcion' => 'Cambio completo de frenos',
                'realizado_por' => 'Taller de la empresa',
                'fecha_creacion' => '2025-10-03 02:29:20',
            ),
        ));
        
        
    }
}