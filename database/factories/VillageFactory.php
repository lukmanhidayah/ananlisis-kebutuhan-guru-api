<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VillageFactory extends Factory
{
    protected $model = \App\Models\Village::class;

    public function definition(): array
    {
        return [
            'district_id' => \App\Models\District::factory(),
            'name' => $this->faker->streetName(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
