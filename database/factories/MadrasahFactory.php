<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Madrasah>
 */
class MadrasahFactory extends Factory
{
    protected $model = \App\Models\Madrasah::class;

    public function definition(): array
    {
        return [
            'nsm' => $this->faker->unique()->numerify('NSM####'),
            'name' => $this->faker->company(),
            'address' => $this->faker->address(),
            'madrasah_level_id' => \App\Models\MadrasahLevel::factory(),
            'regency_id' => 1,
            'district_id' => 1,
            'village_id' => 1,
        ];
    }
}
