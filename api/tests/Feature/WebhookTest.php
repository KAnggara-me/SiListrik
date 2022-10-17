<?php

namespace Tests\Feature;

use Tests\TestCase;

class WebhookTest extends TestCase
{
    public function test_incoming_message_not_ok()
    {
        $response = $this->post('/api/v1/webhooks');
        $response->assertStatus(400);
    }

    public function test_incoming_message_wrong_method()
    {
        $response = $this->get('/api/v1/webhooks');
        $response->assertStatus(405);
    }

    public function test_incoming_message_ok()
    {
        $data = [];
        $response = $this->post('/api/v1/webhooks');
        $response->assertStatus(400);
    }
}
