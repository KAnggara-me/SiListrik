<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_user_status()
    {
        $response = $this->get('/api/v1/status/admina/KitKat');
        $response->assertSee('status');
        $response->assertStatus(200);
    }
}
