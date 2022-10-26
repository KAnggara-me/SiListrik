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

        SensorLog::create(['voltase' => 220, 'arus' => 4, 'temperatur' => 20, 'kelembaban' => 70, 'asap' => 250, 'api' => 0]); // Aman
        SensorLog::create(['voltase' => 245, 'arus' => 1, 'temperatur' => 20, 'kelembaban' => 70, 'asap' => 250, 'api' => 0]); // Over Voltage
        SensorLog::create(['voltase' => 220, 'arus' => 4, 'temperatur' => 70, 'kelembaban' => 70, 'asap' => 250, 'api' => 0]); // High Temp
        SensorLog::create(['voltase' => 220, 'arus' => 9, 'temperatur' => 20, 'kelembaban' => 70, 'asap' => 250, 'api' => 0]); // Over Load
        SensorLog::create(['voltase' => 220, 'arus' => 4, 'temperatur' => 70, 'kelembaban' => 70, 'asap' => 450, 'api' => 3]); // Kebakaran
        SensorLog::create(['voltase' => 220, 'arus' => 4, 'temperatur' => 24, 'kelembaban' => 24, 'asap' => 450, 'api' => 0]); // Asap
        SensorLog::create(['voltase' => 220, 'arus' => 4, 'temperatur' => 20, 'kelembaban' => 20, 'asap' => 250, 'api' => 3]); // Api
    }
}
