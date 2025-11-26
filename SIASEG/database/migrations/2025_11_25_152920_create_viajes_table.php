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
        Schema::create('viajes', function (Blueprint $table) {
            $table->id('id_viaje');

            // Relación Empleado
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id_empleado')->on('empleados');

            // Relación Transportista (AQUÍ ESTABA EL ERROR)
            $table->unsignedBigInteger('transportista_id');
            $table->foreign('transportista_id')->references('id_transporte')->on('transportes');

            // Relación Ruta
            $table->unsignedBigInteger('ruta_id');
            $table->foreign('ruta_id')->references('id_ruta')->on('rutas');

            $table->enum('estado', ['pendiente', 'en_curso', 'finalizado', 'cancelado']);
            $table->date('fecha_programada');
            $table->dateTime('hora_inicio_real')->nullable();
            $table->dateTime('hora_fin_real')->nullable();
            $table->dateTime('fecha_creacion')->nullable()->useCurrent();
            $table->dateTime('fecha_actualizacion')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viajes');
    }
};
