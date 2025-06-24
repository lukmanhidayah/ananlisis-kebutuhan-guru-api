<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_users_with_pagination(): void
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'result' => [
                    'currentPage',
                    'data' => [
                        ['id', 'name', 'email', 'roleId']
                    ],
                ],
            ]);
    }

    public function test_can_filter_users_by_email(): void
    {
        $user = User::factory()->create(['email' => 'specific@example.com']);
        User::factory()->count(2)->create();

        $response = $this->getJson('/api/v1/users?email=specific@example.com');

        $response->assertStatus(200)
            ->assertJsonPath('result.data.0.email', 'specific@example.com');
    }
}
