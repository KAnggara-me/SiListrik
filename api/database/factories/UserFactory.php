<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'username' => strtolower(fake()->firstname() . fake()->lastname()),
      'password' => bcrypt('admina'),
      'token' => tokenGen(),
      'apitoken' => tokenGen(),
    ];
  }
}
