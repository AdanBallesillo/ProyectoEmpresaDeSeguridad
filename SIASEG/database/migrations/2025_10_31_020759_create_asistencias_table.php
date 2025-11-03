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
            $table->integer('id_asistencia');
            $table->integer('empleado_id');
            $table->integer('turno_id');
            $table->integer('estacion_id')->nullable();
            $table->integer('zona_id')->nullable();
            $table->dateTime('fecha_registro')->useCurrent();
            $table->enum('status_asistencia', ['A tiempo', 'Tarde', 'Falta']);
            $table->enum('STATUS', ['Activo', 'Inactivo']);
            $table->text('comentario')->nullable();
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
