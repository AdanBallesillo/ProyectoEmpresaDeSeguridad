<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EmpleadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('empleados')->delete();
        
        \DB::table('empleados')->insert(array (
            0 => 
            array (
                'id_empleado' => 2,
                'nombres' => 'Jose',
                'apellidos' => 'Vega',
                'CURP' => 'cca567898hjcgrna3',
                'RFC' => 'cca567898hjc',
                'telefono' => '4741765411',
                'fotografia' => 'storage/fotos/1760666512_Vega Torres José Manuel.jpeg',
                'no_empleado' => '485276',
                'password' => '$2y$12$4sdBSo.ej.KqxKsiPYfVMOMrGNvY5FBZPsE5NKSlD.u2A5mabfqxi',
                'rol' => 'Empleado',
                'correo' => 'pepin@gmail.com',
                'fecha_creacion' => '2025-10-17 04:01:52',
                'fecha_actualizacion' => '2025-10-17 04:01:52',
                'status' => 'Activo',
            ),
            1 => 
            array (
                'id_empleado' => 3,
                'nombres' => 'Jose Manuel',
                'apellidos' => 'Vega',
                'CURP' => 'vetm041013hjcgnra4',
                'RFC' => 'vetm041013hjc',
                'telefono' => '4747474747',
                'fotografia' => 'storage/fotos/1760847392_Diagrama en blanco.png',
                'no_empleado' => '612747',
                'password' => '$2y$12$McIJbdwdhIaGTiAaLGyQTuSIQoxJbWW/GkC/DrJNsDQRGomBVxmmy',
                'rol' => 'Administrador',
                'correo' => 'elue@gmail.com',
                'fecha_creacion' => '2025-10-19 06:16:34',
                'fecha_actualizacion' => '2025-10-19 06:16:34',
                'status' => 'Activo',
            ),
            2 => 
            array (
                'id_empleado' => 4,
                'nombres' => 'Adan',
                'apellidos' => 'Balesillo Velazquez',
                'CURP' => 'BAVA030424HJCLLDA0',
                'RFC' => 'BAVA0403QA',
                'telefono' => '3951181280',
                'fotografia' => 'storage/fotos/1760915285_rostro_autorizado.jpg',
                'no_empleado' => '556091',
                'password' => '$2y$12$BVSKiS1YKBPiBmkrxVgQWe7Kj6ud9mgwP6BWRQRp.Omt0wd1O0aHO',
                'rol' => 'Administrador',
                'correo' => 'adanballesillo@gmail.com',
                'fecha_creacion' => '2025-10-20 01:08:06',
                'fecha_actualizacion' => '2025-10-20 01:08:06',
                'status' => 'Activo',
            ),
            3 => 
            array (
                'id_empleado' => 5,
                'nombres' => 'Pedro',
                'apellidos' => 'Gonzalez Reynoso',
                'CURP' => 'PACA080615HJCLLDE0',
                'RFC' => 'PACA0806QA',
                'telefono' => '7584125962',
                'fotografia' => 'storage/fotos/1760917190_LogoSinFondo.png',
                'no_empleado' => '262107',
                'password' => '$2y$12$g9T.2x2yYKNn/X69TONaa.0VBSJcb3k1k2Y/8EQrGuxaMOX2DJYDW',
                'rol' => 'Transportista',
                'correo' => 'pedro@gmail.com',
                'fecha_creacion' => '2025-10-20 01:39:51',
                'fecha_actualizacion' => '2025-10-20 03:11:18',
                'status' => 'Activo',
            ),
            4 => 
            array (
                'id_empleado' => 6,
                'nombres' => 'Uriel',
                'apellidos' => 'Saavdra',
                'CURP' => '1234567890',
                'RFC' => '1234567890',
                'telefono' => '4741234567',
                'fotografia' => 'storage/fotos/1761000092_Izta.png',
                'no_empleado' => '389114',
                'password' => '$2y$12$ER.5/Fk7F/HzpDUSiJw25.Z.WVMHJqZLfrv5O/LSxz84ILGv0URIS',
                'rol' => 'Empleado',
                'correo' => 'user@gmail.com',
                'fecha_creacion' => '2025-10-21 00:41:33',
                'fecha_actualizacion' => '2025-10-28 23:38:40',
                'status' => 'Activo',
            ),
            5 => 
            array (
                'id_empleado' => 7,
                'nombres' => 'Jhonatan',
                'apellidos' => 'Guerrero Rocha',
                'CURP' => 'RACW050729MMCSHNA2',
                'RFC' => 'PEGJ850223XXX',
                'telefono' => '4567897654',
                'fotografia' => 'storage/fotos/1761076301_gatonegronaranja.jpg',
                'no_empleado' => '433063',
                'password' => '$2y$12$HQ5k9EI0EYSHK/05phIDVe.Jwb4ZPuhFd8V1y9jSvTUX.VqmWcO4u',
                'rol' => 'Secretaria',
                'correo' => 'Roxana@gmail.com',
                'fecha_creacion' => '2025-10-21 21:51:42',
                'fecha_actualizacion' => '2025-10-21 21:51:42',
                'status' => 'Activo',
            ),
            6 => 
            array (
                'id_empleado' => 9,
                'nombres' => 'nenuco',
                'apellidos' => 'Trejo',
                'CURP' => 'GFCHCHFCHFCHFCHGFC',
                'RFC' => 'GFCGFGFGFCGFG',
                'telefono' => '4741765411',
                'fotografia' => NULL,
                'no_empleado' => '983139',
                'password' => '$2y$12$sTS.3OURutdWBhBInNqWpeGOAvNAv4DklRK1trATzzyZeh0qLamiu',
                'rol' => 'Secretaria',
                'correo' => 'pepinillo@gmail.com',
                'fecha_creacion' => '2025-10-22 00:28:17',
                'fecha_actualizacion' => '2025-10-22 00:52:10',
                'status' => 'Activo',
            ),
            7 => 
            array (
                'id_empleado' => 10,
                'nombres' => 'cristofer',
                'apellidos' => 'pachuca',
                'CURP' => 'sdfa234rwe',
                'RFC' => 'asarsd',
                'telefono' => '3956882890',
                'fotografia' => 'storage/fotos/1761834170_Screenshot_20251029_211232_Chrome_092516.jpg',
                'no_empleado' => '422302',
                'password' => '$2y$12$QZPs9d2Z7ItFrIrCoJbYiO5odCi8iO.IS4cmouEDmImLNSuwc0MuW',
                'rol' => 'Empleado',
                'correo' => 'dballesillovelazquez@gmail.com',
                'fecha_creacion' => '2025-10-30 22:22:53',
                'fecha_actualizacion' => '2025-10-30 22:22:53',
                'status' => 'Activo',
            ),
        ));
        
        
    }
}