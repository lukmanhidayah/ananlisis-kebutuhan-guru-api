<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserDetailApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_user_detail(): void
    {
        $user = User::factory()->create();
        $auth = User::factory()->create(['password' => bcrypt('secret')]);

        $login = $this->postJson('/api/v1/login', [
            'email' => $auth->email,
            'password' => 'secret',
        ]);

        $token = $login->json('result.token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/v1/users/' . $user->id);

        $response->assertStatus(200)
            ->assertJsonPath('result.id', $user->id);
    }
}
