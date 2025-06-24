<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassLevel;
use App\Models\MadrasahLevel;

class ClassLevelSeeder extends Seeder
{
    public function run(): void
    {
        $mi = MadrasahLevel::where('name', 'Madrasah Ibtidaiyah (MI)')->first();
        $mts = MadrasahLevel::where('name', 'Madrasah Tsanawiyah (MTs)')->first();
        $ma = MadrasahLevel::where('name', 'Madrasah Aliyah (MA)')->first();

        if (!$mi || !$mts || !$ma) {
            return;
        }

        $levels = [
            $mi->id => ['I', 'II', 'III', 'IV', 'V', 'VI'],
            $mts->id => ['VII', 'VIII', 'IX'],
            $ma->id => ['X', 'XI', 'XII'],
        ];

        foreach ($levels as $madrasahId => $classes) {
            foreach ($classes as $name) {
                ClassLevel::firstOrCreate(
                    ['name' => $name],
                    ['madrasah_level_id' => $madrasahId]
                );
            }
        }
    }
}
