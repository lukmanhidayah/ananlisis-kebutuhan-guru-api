<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidationErrorApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_error_format(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->postJson('/api/v1/madrasahs', []);

        $response->assertStatus(422)
            ->assertJsonPath('meta.message', 'Validation Error')
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'errors' => [
                    'nsm',
                    'name',
                    'address',
                    'madrasahLevelId',
                    'regencyId',
                    'districtId',
                    'villageId',
                ],
            ]);
    }
}
