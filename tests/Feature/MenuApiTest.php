<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_menus_for_authenticated_user(): void
    {
        $user = User::factory()->create(['password' => bcrypt('secret')]);
        Menu::factory()->count(2)->create(['role_id' => $user->role_id]);

        $login = $this->postJson('/api/v1/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $token = $login->json('result.token');

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->getJson('/api/v1/menus');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'result' => [
                    ['id', 'roleId', 'name', 'url']
                ],
            ])
            ->assertJsonCount(2, 'result');
    }
}
