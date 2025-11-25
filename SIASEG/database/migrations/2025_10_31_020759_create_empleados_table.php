<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id('id_empleado');
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('CURP', 18);
            $table->string('RFC', 13);
            $table->string('telefono', 15)->nullable();
            $table->string('fotografia')->nullable();
            $table->string('no_empleado', 30);
            $table->string('password', 65);
            $table->string('rol', 100)->nullable();
            $table->string('correo', 150);
            $table->dateTime('fecha_creacion')->nullable()->useCurrent();
            $table->dateTime('fecha_actualizacion')->useCurrentOnUpdate()->nullable()->useCurrent();
            $table->enum('status', ['Activo', 'Inactivo'])->nullable()->default('Activo');
            // Nueva columna
            $table->boolean('cambiar_pass')->nullable()->default(true);
            // Nueva columna para checar disponibilidad
            $table->boolean('disponible')->nullable()->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
