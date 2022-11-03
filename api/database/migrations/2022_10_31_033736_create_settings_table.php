<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->string('admin')->nullable(true);
			$table->integer('daya')->default(900);
			$table->integer('limit')->default(800);
			$table->integer('tmax')->default(30);
			$table->integer('asap')->default(300);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('settings');
	}
};
