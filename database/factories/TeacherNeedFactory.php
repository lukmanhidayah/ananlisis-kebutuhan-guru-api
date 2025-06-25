<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Madrasah;
use App\Models\Subject;
use App\Models\AcademicYear;
use App\Models\CalculationMethod;

class TeacherNeedFactory extends Factory
{
    protected $model = \App\Models\TeacherNeed::class;

    public function definition(): array
    {
        return [
            'madrasah_id' => Madrasah::factory(),
            'subject_id' => Subject::factory(),
            'academic_year_id' => AcademicYear::factory(),
            'calculation_method_id' => CalculationMethod::factory(),
        ];
    }
}
