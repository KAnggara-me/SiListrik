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
		Schema::create('statuses', function (Blueprint $table) {
			$table->id();
			$table->float('voltase')->default(220);
			$table->float('arus')->default(1);
			$table->float('temperatur')->default(25);
			$table->float('kelembaban')->default(50);
			$table->float('asap')->default(0);
			$table->integer('api')->default(0);
			$table->string('images');
			$table->boolean('isUsage')->default(0);
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
		Schema::dropIfExists('statuses');
	}
};
