<?php

namespace Database\Seeders;

use App\Models\Relay;
use Illuminate\Database\Seeder;

class RelaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Relay::create([
            'status' => false,
        ]);
    }
}
