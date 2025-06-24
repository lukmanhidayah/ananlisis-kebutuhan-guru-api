<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubjectApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_subject(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/subjects', [
                'name' => 'Math',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('result.name', 'Math');

        $id = $response->json('result.id');

        $update = $this->actingAs($user)
            ->putJson('/api/v1/subjects/' . $id, [
                'name' => 'Updated',
            ]);

        $update->assertStatus(200)
            ->assertJsonPath('result.name', 'Updated');

        $delete = $this->actingAs($user)
            ->deleteJson('/api/v1/subjects/' . $id);

        $delete->assertStatus(200)
            ->assertJsonPath('meta.message', 'Data berhasil dihapus');
    }
}
