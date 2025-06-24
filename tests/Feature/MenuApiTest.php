<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_menus_with_pagination(): void
    {
        $user = User::factory()->create(['password' => bcrypt('secret')]);
        $menus = Menu::factory()->count(3)->create();
        foreach ($menus as $menu) {
            $menu->roles()->attach($user->role_id);
        }

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
                'data' => [
                    'currentPage',
                    'data',
                ],
            ]);

        $this->assertArrayHasKey('iconType', $response->json('result.data.0'));
    }
}
