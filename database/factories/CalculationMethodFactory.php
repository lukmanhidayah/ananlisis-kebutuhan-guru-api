<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CalculationMethodFactory extends Factory
{
    protected $model = \App\Models\CalculationMethod::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'divisor_value' => 1,
        ];
    }
}
