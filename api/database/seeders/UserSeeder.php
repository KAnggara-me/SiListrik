<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create([
      'username' => 'admina',
      'password' => bcrypt('admina'),
      'token' => 'KitKat',
      'apitoken' => 'y0xgWUtKbmOLYe_wcI^RFNK5imm8qC99V}OXodIti4RJpn{@-kelvin',
    ]);
    User::create([
      'username' => 'zuhryy',
      'password' => bcrypt('zuhryy'),
      'token' => 'Lolipop',
      'apitoken' => 'y0xgWUtKbmOLYe_wcI^RFNK5imm8qC99V}OXodIti4RJpn{@-kelvin',
    ]);
    User::factory(10)->create();
  }
}
