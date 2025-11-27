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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');

            // Relación con empleados, turnos, estaciones
            $table->integer('empleado_id');
            $table->integer('turno_id');
            $table->integer('estacion_id')->nullable();

            // Registro de fecha/hora en que se creó
            $table->dateTime('fecha_registro')->useCurrent();

            // Estado de asistencia
            $table->enum('status_asistencia', ['A tiempo', 'Tarde', 'Falta']);

            // Registro de ENTRADA
            $table->string('foto_entrada')->nullable();
            $table->time('hora_entrada')->nullable();

            // Registro de SALIDA
            $table->string('foto_salida')->nullable();
            $table->time('hora_salida')->nullable();

            // Fecha de actualización automática
            $table->dateTime('fecha_actualizacion')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
