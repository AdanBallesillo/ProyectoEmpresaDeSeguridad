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
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('id_asignacion');
            $table->unsignedBigInteger('id_estacionPK');
            $table->unsignedBigInteger('id_usuarioPK');

            // Llaves foráneas
            $table->foreign('id_estacionPK')->foreign()->references('id_estacion')->on('estaciones')->OnDelete('cascade');
            $table->foreign('id_usuarioPK')->foreign()->references('id_empleado')->on('empleados')->OnDelete('cascade');

            // turno
            $table->enum('turno', ['Matutino', 'Vespertino', 'Nocturno']);

            // Fechas para sistema de turnos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
