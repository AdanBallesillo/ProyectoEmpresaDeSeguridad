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
        Schema::create('mantenimientos', function (Blueprint $table) {
            $table->id('id_mantenimiento');
            $table->integer('transporte_id');
            $table->date('fecha_servicio');
            $table->string('tipo_servicio', 100);
            $table->text('descripcion')->nullable();
            $table->string('realizado_por', 100)->nullable();
            $table->dateTime('fecha_creacion')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mantenimientos');
    }
};
