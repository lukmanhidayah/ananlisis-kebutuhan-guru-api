<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_receive_token(): void
    {
        $response = $this->postJson('/api/v1/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'secret',
            'passwordConfirmation' => 'secret',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'result' => ['token'],
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'status' => 'active',
        ]);
    }
}
