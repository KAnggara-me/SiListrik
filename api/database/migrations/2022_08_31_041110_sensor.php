<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sensor', function (Blueprint $table) {
      $table->id();
      $table->float('voltase');
      $table->float('ampere');
      $table->float('temperatur');
      $table->float('kelembapan');
      $table->float('asap');
      $table->integer('api')->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('sensor');
  }
};
