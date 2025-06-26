<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Regency;
use App\Models\User;
use App\Models\Village;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LocationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_regencies(): void
    {
        Regency::factory()->count(3)->create();

        $response = $this->actingAs(User::factory()->create())
            ->getJson('/api/v1/regencies');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => ['code', 'message'],
                'data' => ['currentPage', 'result'],
            ]);
    }

    public function test_filter_districts_by_regency_id(): void
    {
        $regency = Regency::factory()->create();
        $district = District::factory()->create(['regency_id' => $regency->id]);
        District::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->getJson('/api/v1/districts?regencyId=' . $regency->id);

        $response->assertStatus(200)
            ->assertJsonPath('result.total', 1)
            ->assertJsonPath('result.result.0.id', $district->id);
    }

    public function test_filter_villages_by_district_id(): void
    {
        $district = District::factory()->create();
        $village = Village::factory()->create(['district_id' => $district->id]);
        Village::factory()->create();

        $response = $this->actingAs(User::factory()->create())
            ->getJson('/api/v1/villages?districtId=' . $district->id);

        $response->assertStatus(200)
            ->assertJsonPath('result.total', 1)
            ->assertJsonPath('result.result.0.id', $village->id);
    }
}
