<?php

namespace Database\Seeders;

use App\Models\Webhook as ModelsWebhook;
use Illuminate\Database\Seeder;

class WebhookSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ModelsWebhook::create([
      'id' => 'kwid-426564a5db7940288dc9fddb812',
      'type' => 'send_message_response',
      'status' => 'success',
      'webhook_msg' => 'Message sent successfully',
      'message' => 'Hallo ini Test',
      'phone_number' => '6281234567890',
      'device_id' => 'admina',
      'message_type' => 'text',
      'caption' => 'null',
    ]);
  }
}
