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
            $yearCode = $year . '/' . $next;
            
            // Create Semester I (July - December)
            AcademicYear::firstOrCreate(
                ['code' => 'Semester I (' . $yearCode . ')'],
                [
                    'start_date' => $year . '-07-01',
                    'end_date' => $year . '-12-31',
                ]
            );
            
            // Create Semester II (January - June)
            AcademicYear::firstOrCreate(
                ['code' => 'Semester II (' . $yearCode . ')'],
                [
                    'start_date' => $next . '-01-01',
                    'end_date' => $next . '-06-30',
                ]
            );
        }
    }
}