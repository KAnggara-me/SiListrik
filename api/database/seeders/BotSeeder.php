<?php

namespace Database\Seeders;

use App\Models\Bot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
			"trigger" => "test",
			"device_id" => "admina",
			"description" => "Testing",
			"response" => "test response",
		]);
		Bot::create([
			"trigger" => "test1",
			"device_id" => "admina",
			"description" => "Testing1",
			"response" => "test response",
		]);
		Bot::create([
			"trigger" => "test2",
			"device_id" => "admina",
			"description" => "Testing2",
			"response" => "test response",
		]);
		Bot::create([
			"trigger" => "test3",
			"device_id" => "admina",
			"description" => "Testing3",
			"response" => "test response",
		]);
	}
}
