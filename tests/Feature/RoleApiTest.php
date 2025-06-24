<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_roles_with_pagination(): void
    {
        Role::factory()->count(3)->create();

        $response = $this->actingAs(User::factory()->create())
            ->getJson('/api/v1/roles');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'result' => ['currentPage', 'data'],
            ]);
    }
}
