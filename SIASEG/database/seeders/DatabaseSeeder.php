<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->call(EmpleadosTableSeeder::class);
        $this->call(EstacionesTableSeeder::class);
        $this->call(MantenimientosTableSeeder::class);
        $this->call(TurnosTableSeeder::class);
        $this->call(TransportesTableSeeder::class);
        $this->call(AsistenciasTableSeeder::class);
    }
}
