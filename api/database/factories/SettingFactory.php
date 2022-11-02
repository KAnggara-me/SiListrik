<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'user_id' => User::factory(),
			'admin' => '6282284705204',
			'daya' => $this->faker->randomElement([900, 1300, 2200]),
			'limit' => $this->faker->randomElement([800, 1000, 2000]),
			'tmax' => rand(28, 35),
			'asap' => rand(250, 350),
		];
	}
}
