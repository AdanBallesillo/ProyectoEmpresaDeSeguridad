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
        Schema::create('logs', function (Blueprint $table) {
            $table->id('id_log');
            $table->integer('empleado_id')->nullable();
            $table->string('accion', 80);
            $table->dateTime('fecha_accion')->useCurrent();
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_creacion')->nullable()->useCurrent();
            $table->dateTime('fecha_actualizacion')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
