<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TeacherNeed;
use App\Models\CalculationMethod;

class TeacherNeedCalculationFactory extends Factory
{
    protected $model = \App\Models\TeacherNeedCalculation::class;

    public function definition(): array
    {
        return [
            'teacher_need_id' => TeacherNeed::factory(),
            'calculation_date' => now(),
            'calculation_method_id' => CalculationMethod::factory(),
            'teacher_existing_count' => 0,
            'result' => $this->faker->randomFloat(2, -3, 3),
        ];
    }
}
