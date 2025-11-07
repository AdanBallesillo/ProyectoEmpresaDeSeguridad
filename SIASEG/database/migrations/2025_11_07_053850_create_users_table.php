<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id(); // equivale a BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY
      $table->string('name', 255);
      $table->string('email', 255)->unique();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password', 255);
      $table->string('remember_token', 100)->nullable();
      $table->timestamp('created_at')->nullable()->useCurrent();
      $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
