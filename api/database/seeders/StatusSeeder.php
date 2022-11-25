<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create(['voltase' => 220, 'arus' => 4, 'temperatur' => 20, 'kelembaban' => 70, 'asap' => 250, 'api' => 0, 'isUsage' => 1, 'images' => "images/img.jpg"]); // Aman
    }
}
