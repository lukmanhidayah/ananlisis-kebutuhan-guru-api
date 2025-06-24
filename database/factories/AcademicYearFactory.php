<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    protected $model = \App\Models\AcademicYear::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-2 years', 'now');
        $end = (clone $start)->modify('+6 months');
        return [
            'code' => $start->format('Y') . '/' . $end->format('Y'),
            'start_date' => $start->format('Y-m-d'),
            'end_date' => $end->format('Y-m-d'),
        ];
    }
}
