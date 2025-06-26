<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Madrasah;
use App\Models\MadrasahLevel;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class MadrasahSeeder extends Seeder
{
    public function run(): void
    {
        $regency = Regency::factory()->create();
        $district = District::factory()->create([
            'regency_id' => $regency->id,
        ]);
        $village = Village::factory()->create([
            'district_id' => $district->id,
        ]);

        $level = MadrasahLevel::first();
        if (!$level) {
            $level = MadrasahLevel::factory()->create();
        }

        Madrasah::factory()
            ->count(10)
            ->create([
                'madrasah_level_id' => $level->id,
                'regency_id' => $regency->id,
                'district_id' => $district->id,
                'village_id' => $village->id,
            ]);
    }
}
