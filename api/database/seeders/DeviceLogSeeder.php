<?php

namespace Database\Seeders;

use App\Models\DeviceLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeviceLog::create([
            'device_id' => 'admina',
            'status' => 'connected',
        ]);
        DeviceLog::create([
            'device_id' => 'admina',
            'status' => 'disconnected',
        ]);
        DeviceLog::create([
            'device_id' => 'admina',
            'status' => 'connected',
        ]);
        DeviceLog::create([
            'device_id' => 'admina',
            'status' => 'disconnected',
        ]);
    }
}
