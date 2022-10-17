<?php

namespace Database\Seeders;

use App\Models\SensorLog;
use Illuminate\Database\Seeder;

class SensorLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SensorLog::factory(250)->create();
    }
}
