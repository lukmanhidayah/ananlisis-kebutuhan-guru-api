<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        $startYear = 2024;
        $endYear = 2050;

        for ($year = $startYear; $year <= $endYear; $year++) {
            $next = $year + 1;
            AcademicYear::firstOrCreate(
                ['code' => $year . '/' . $next],
                [
                    'start_date' => $year . '-07-01',
                    'end_date' => $next . '-06-30',
                ]
            );
        }
    }
}
