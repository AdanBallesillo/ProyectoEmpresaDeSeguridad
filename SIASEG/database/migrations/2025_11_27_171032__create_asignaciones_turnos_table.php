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

            // Debe coincidir con el tipo de la PK de empleados:
            // si en empleados usas bigIncrements('id_empleado') → unsignedBigInteger
            // si usas increments('id_empleado') → unsignedInteger
            $table->unsignedBigInteger('id_empleado');
            $table->unsignedBigInteger('id_estacion');

            $table->enum('turno', ['Matutino', 'Nocturno']);
            $table->date('fecha');

            $table->timestamps();

            // FK hacia empleados.id_empleado  (NO tocamos la tabla empleados)
            $table->foreign('id_empleado')
                ->references('id_empleado')   // 👈 aquí está el cambio
                ->on('empleados')
                ->onDelete('cascade');

            // Ajusta esto a como esté tu tabla estaciones
            $table->foreign('id_estacion')
                ->references('id_estacion')   // o 'id' si así se llama
                ->on('estaciones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('asignaciones_turnos', function (Blueprint $table) {
            $table->dropForeign(['id_empleado']);
            $table->dropForeign(['id_estacion']);
        });

        Schema::dropIfExists('asignaciones_turnos');
    }
};
