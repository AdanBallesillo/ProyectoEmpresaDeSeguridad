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
        Schema::create('asignaciones_turnos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_estacion');

            $table->enum('turno', ['Matutino', 'Nocturno']);
            $table->date('fecha');

            $table->timestamps();

            // Llave foránea hacia empleados
            $table->foreign('id_empleado')
                ->references('id')
                ->on('empleados')
                ->onDelete('cascade');

            // Llave foránea hacia estaciones
            $table->foreign('id_estacion')
                ->references('id')
                ->on('estaciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones_turnos');
    }
};
