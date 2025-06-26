<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DistrictFactory extends Factory
{
    protected $model = \App\Models\District::class;

    public function definition(): array
    {
        return [
            'regency_id' => \App\Models\Regency::factory(),
            'name' => $this->faker->citySuffix(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
