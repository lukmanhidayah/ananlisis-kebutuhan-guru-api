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
        $level = MadrasahLevel::first();
        if (!$level) {
            $level = MadrasahLevel::factory()->create();
        }

        Madrasah::factory()
            ->count(10)
            ->create([
                'madrasah_level_id' => $level->id,
            ]);
    }
}
