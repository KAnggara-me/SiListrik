<?php

namespace Database\Seeders;

use App\Models\Bot;
use Illuminate\Database\Seeder;

class BotSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Bot::create([
			"trigger" => "start",
			"device_id" => "admina",
			"description" => "Welcome to the bot",
			"response" => "_Selamat Datang di Bot Whatsapp_",
		]);
		Bot::create([
			"trigger" => "assalamualaikum",
			"device_id" => "admina",
			"description" => "salam",
			"response" => "Waalaikumsalam",
		]);
		Bot::create([
			"trigger" => "test",
			"device_id" => "admina",
			"description" => "Testing3",
			"response" => "test berhasil",
		]);
		Bot::create([
			"trigger" => "halo",
			"device_id" => "admina",
			"description" => "Hallo",
			"response" => "Halo juga",
		]);
		Bot::create([
			"trigger" => "help",
			"device_id" => "admina",
			"description" => "Help",
			"response" => "*List Command* \n\n0. *Status* : Menampilkan Data Sensor \n1. *start* \n2. *assalamualaikum* \n3. *test* \n4. *halo* \n5. *help*",
		]);
	}
}
