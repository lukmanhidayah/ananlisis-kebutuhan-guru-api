<?php

namespace Tests\Feature;

use App\Models\ClassLevel;
use App\Models\MadrasahLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClassLevelApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_class_level(): void
    {
        $level = MadrasahLevel::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/class-levels', [
                'name' => 'I',
                'description' => 'desc',
                'madrasahLevelId' => $level->id,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('result.name', 'I');

        $id = $response->json('result.id');

        $update = $this->actingAs($user)
            ->putJson('/api/v1/class-levels/' . $id, [
                'name' => 'Updated',
            ]);

        $update->assertStatus(200)
            ->assertJsonPath('result.name', 'Updated');

        $delete = $this->actingAs($user)
            ->deleteJson('/api/v1/class-levels/' . $id);

        $delete->assertStatus(200)
            ->assertJsonPath('meta.message', 'Data berhasil dihapus');
    }
}
