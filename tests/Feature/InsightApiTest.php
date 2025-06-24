<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsightApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_insight_endpoint_returns_data(): void
    {
        $user = User::factory()->create(['password' => bcrypt('secret')]);

        $login = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $token = $login->json('result.token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/v1/insights');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'result' => [
                    ['title', 'value'],
                ],
            ]);
    }
}
