<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EstacionesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('estaciones')->delete();
        
        \DB::table('estaciones')->insert(array (
            0 => 
            array (
                'id_estacion' => 1,
                'nombre_estacion' => 'Estación Norte',
                'codigo_estacion' => 'EN001',
                'lat_sup_izq' => '21.123456',
                'lon_sup_izq' => '-101.123456',
                'lat_inf_der' => '21.120000',
                'lon_inf_der' => '-101.120000',
                'tipo' => 'Estacion',
                'descripcion' => 'Estación ubicada al norte de la ciudad',
                'fecha_creacion' => '2025-09-27 06:23:31',
                'fecha_actualizacion' => '2025-09-27 06:23:31',
                'status' => 'Activo',
            ),
            1 => 
            array (
                'id_estacion' => 2,
                'nombre_estacion' => 'Zona Centro',
                'codigo_estacion' => 'ZC002',
                'lat_sup_izq' => '21.456789',
                'lon_sup_izq' => '-101.456789',
                'lat_inf_der' => '21.450000',
                'lon_inf_der' => '-101.450000',
                'tipo' => 'Zona',
                'descripcion' => 'Zona de monitoreo en el centro histórico',
                'fecha_creacion' => '2025-09-27 06:23:31',
                'fecha_actualizacion' => '2025-09-27 06:23:31',
                'status' => 'Activo',
            ),
            2 => 
            array (
                'id_estacion' => 3,
                'nombre_estacion' => 'Estación Sur',
                'codigo_estacion' => 'ES003',
                'lat_sup_izq' => '20.987654',
                'lon_sup_izq' => '-101.987654',
                'lat_inf_der' => '20.980000',
                'lon_inf_der' => '-101.980000',
                'tipo' => 'Estacion',
                'descripcion' => 'Estación ubicada al sur de la ciudad',
                'fecha_creacion' => '2025-09-27 06:23:31',
                'fecha_actualizacion' => '2025-09-27 06:23:31',
                'status' => 'Inactivo',
            ),
            3 => 
            array (
                'id_estacion' => 4,
                'nombre_estacion' => 'Zona Industrial',
                'codigo_estacion' => 'ZI004',
                'lat_sup_izq' => '21.234567',
                'lon_sup_izq' => '-101.234567',
                'lat_inf_der' => '21.230000',
                'lon_inf_der' => '-101.230000',
                'tipo' => 'Zona',
                'descripcion' => 'Zona de monitoreo en área industrial',
                'fecha_creacion' => '2025-09-27 06:23:31',
                'fecha_actualizacion' => '2025-09-27 06:23:31',
                'status' => 'Activo',
            ),
            4 => 
            array (
                'id_estacion' => 5,
                'nombre_estacion' => 'Estación Este',
                'codigo_estacion' => 'EE005',
                'lat_sup_izq' => '21.345678',
                'lon_sup_izq' => '-101.345678',
                'lat_inf_der' => '21.340000',
                'lon_inf_der' => '-101.340000',
                'tipo' => 'Estacion',
                'descripcion' => 'Estación ubicada al este de la ciudad',
                'fecha_creacion' => '2025-09-27 06:23:31',
                'fecha_actualizacion' => '2025-09-27 06:23:31',
                'status' => 'Inactivo',
            ),
        ));
        
        
    }
}