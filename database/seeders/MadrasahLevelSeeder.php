<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MadrasahLevel;

class MadrasahLevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            'Madrasah Ibtidaiyah (MI)',
            'Madrasah Tsanawiyah (MTs)',
            'Madrasah Aliyah (MA)',
        ];

        foreach ($levels as $level) {
            MadrasahLevel::firstOrCreate(['name' => $level]);
        }
    }
}
