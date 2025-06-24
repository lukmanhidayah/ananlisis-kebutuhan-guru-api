<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ClassLevel>
 */
class ClassLevelFactory extends Factory
{
    protected $model = \App\Models\ClassLevel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'madrasah_level_id' => \App\Models\MadrasahLevel::factory(),
        ];
    }
}
