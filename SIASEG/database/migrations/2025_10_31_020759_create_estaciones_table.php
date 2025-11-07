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
    Schema::create('estaciones', function (Blueprint $table) {
      $table->id('id_estacion');
      $table->string('nombre_estacion', 50);
      $table->string('estado', 100);
      $table->string('ciudad', 100);
      $table->string('colonia', 100);
      $table->string('calle', 100);
      $table->integer('n_exterior');
      $table->integer('p_requerido');
      $table->string('codigo_estacion', 10)->nullable();
      $table->decimal('lat_sup_izq', 9, 6);
      $table->decimal('lon_sup_izq', 9, 6);
      $table->decimal('lat_inf_der', 9, 6);
      $table->decimal('lon_inf_der', 9, 6);
      $table->enum('tipo', ['Estacion', 'Zona'])->nullable();
      $table->text('descripcion')->nullable();
      $table->dateTime('fecha_creacion')->nullable()->useCurrent();
      $table->dateTime('fecha_actualizacion')->useCurrentOnUpdate()->nullable()->useCurrent();
      $table->enum('status', ['Activo', 'Inactivo'])->nullable()->default('Activo');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('estaciones');
  }
};
