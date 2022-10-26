<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SensorLog>
 */
class SensorLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'voltase' => $this->faker->randomFloat(2, 200, 250),
            'arus' => $this->faker->randomFloat(2, 0, 10),
            'temperatur' => $this->faker->randomFloat(2, 25, 120),
            'kelembaban' => $this->faker->randomFloat(2, 10, 90),
            'asap' => $this->faker->randomFloat(2, 200, 500),
            'api' => $this->faker->randomElement([0, 1, 2, 3, 4, 5]),
        ];
    }
}
