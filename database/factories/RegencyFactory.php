<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegencyFactory extends Factory
{
    protected $model = \App\Models\Regency::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
