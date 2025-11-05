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
        Schema::create('transportes', function (Blueprint $table) {
            $table->integer('id_transporte');
            $table->string('tipo', 50);
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->year('anio');
            $table->string('placas', 15);
            $table->string('numero_serie', 50);
            $table->decimal('capacidad_carga', 10)->nullable();
            $table->date('fecha_adquisicion')->nullable();
            $table->enum('status', ['Activo', 'En mantenimiento', 'Baja'])->nullable()->default('Activo');
            $table->text('comentarios')->nullable();
            $table->dateTime('fecha_creacion')->nullable()->useCurrent();
            $table->dateTime('fecha_actualizacion')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transportes');
    }
};
