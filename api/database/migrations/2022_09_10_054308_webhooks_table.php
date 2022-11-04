<?php

use App\Models\User;
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
		Schema::create('webhooks', function (Blueprint $table) {
			$table->string('id')->unique()->primary();
			$table->enum('type', ['send_message_response', 'incoming_message', 'device_status_changed']); //send_message_response]]]]]]]]]]
			$table->enum('status', ['success', 'fail', 'pending']); // fail or success
			$table->string('webhook_msg'); // message

			// Paylod section
			$table->string('message')->nullable(); // message
			$table->string('phone_number'); // phone number
			$table->string('device_id');
			$table->foreign('device_id')->references('username')->on('users');
			$table->string('message_type')->default('text'); // message type
			$table->string('caption')->nullable();

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
		Schema::dropIfExists('webhooks');
	}
};
