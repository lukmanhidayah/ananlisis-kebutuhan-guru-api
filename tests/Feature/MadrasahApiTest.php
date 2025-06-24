<?php

namespace Tests\Feature;

use App\Models\Madrasah;
use App\Models\MadrasahLevel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MadrasahApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_madrasah(): void
    {
        $level = MadrasahLevel::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/madrasahs', [
                'nsm' => '1234',
                'name' => 'Madrasah Test',
                'address' => 'Address',
                'madrasah_level_id' => $level->id,
                'regency_id' => 1,
                'district_id' => 1,
                'village_id' => 1,
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('result.name', 'Madrasah Test');

        $id = $response->json('result.id');

        $update = $this->actingAs($user)
            ->putJson('/api/v1/madrasahs/'.$id, [
                'name' => 'Updated',
            ]);

        $update->assertStatus(200)
            ->assertJsonPath('result.name', 'Updated');

        $delete = $this->actingAs($user)
            ->deleteJson('/api/v1/madrasahs/'.$id);

        $delete->assertStatus(200)
            ->assertJsonPath('meta.message', 'Deleted');
    }
}
