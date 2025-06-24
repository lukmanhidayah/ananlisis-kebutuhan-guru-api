<?php

namespace Tests\Feature;

use App\Models\MadrasahLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MadrasahLevelApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_madrasah_level(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/madrasah-levels', [
                'name' => 'MI',
                'description' => 'desc',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('result.name', 'MI');

        $id = $response->json('result.id');

        $update = $this->actingAs($user)
            ->putJson('/api/v1/madrasah-levels/' . $id, [
                'name' => 'Updated',
            ]);

        $update->assertStatus(200)
            ->assertJsonPath('result.name', 'Updated');

        $delete = $this->actingAs($user)
            ->deleteJson('/api/v1/madrasah-levels/' . $id);

        $delete->assertStatus(200)
            ->assertJsonPath('meta.message', 'Data berhasil dihapus');
    }
}
