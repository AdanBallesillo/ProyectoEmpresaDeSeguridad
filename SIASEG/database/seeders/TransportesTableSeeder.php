<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransportesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('transportes')->delete();
        
        \DB::table('transportes')->insert(array (
            0 => 
            array (
                'id_transporte' => 1,
                'tipo' => 'Camión',
                'marca' => 'Kenworth',
                'modelo' => 'T680',
                'anio' => '2022',
                'placas' => 'ABC-1234',
                'numero_serie' => '1XKAD49X2CJ123456',
                'capacidad_carga' => '18.00',
                'fecha_adquisicion' => '2022-03-15',
                'status' => 'Activo',
                'comentarios' => 'Unidad principal',
                'fecha_creacion' => '2025-10-03 01:44:06',
                'fecha_actualizacion' => '2025-10-03 01:44:06',
            ),
        ));
        
        
    }
}