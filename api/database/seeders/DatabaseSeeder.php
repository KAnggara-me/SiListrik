<?php

namespace Database\Seeders;

use App\Models\SensorLog;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call([
      UserSeeder::class,
      WebhookSeeder::class,
      BotSeeder::class,
      SensorLogSeeder::class,
      DeviceLogSeeder::class,
    ]);
  }
}
