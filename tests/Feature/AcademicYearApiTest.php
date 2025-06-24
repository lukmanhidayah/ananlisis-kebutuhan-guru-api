<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AcademicYearApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_crud_academic_year(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/academic-years', [
                'code' => '2024/2025',
                'startDate' => '2024-07-01',
                'endDate' => '2025-06-30',
            ]);

        $response->assertStatus(201)
            ->assertJsonPath('result.code', '2024/2025');

        $id = $response->json('result.id');

        $update = $this->actingAs($user)
            ->putJson('/api/v1/academic-years/' . $id, [
                'code' => '2025/2026',
            ]);

        $update->assertStatus(200)
            ->assertJsonPath('result.code', '2025/2026');

        $delete = $this->actingAs($user)
            ->deleteJson('/api/v1/academic-years/' . $id);

        $delete->assertStatus(200)
            ->assertJsonPath('meta.message', 'Data berhasil dihapus');
    }
}
