<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Setting::create([
			'user_id' => 1,
			'admin' => '6282284705204',
			'daya' => 900,
			'limit' => 800,
			'tmax' => 30,
			'asap' => 300,
		]);
		Setting::create([
			'user_id' => 2,
			'admin' => '6282284705204',
			'daya' => 900,
			'limit' => 800,
			'tmax' => 30,
			'asap' => 300,
		]);
		Setting::factory(10)->create();
	}
}
