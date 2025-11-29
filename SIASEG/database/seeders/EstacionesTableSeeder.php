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

    \DB::table('estaciones')->insert(array(
      0 =>
      array(
        'nombre_estacion' => 'Estación Norte',
        'estado'            => 'Jalisco',
        'ciudad'            => 'Lagos de Moreno',
        'colonia'           => 'Centro',
        'calle'             => 'Av. Hidalgo',
        'n_exterior'        => 123,
        'p_requerido'       => 5,
        'codigo_postal' => 'EN001',
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
    ));
  }
}
