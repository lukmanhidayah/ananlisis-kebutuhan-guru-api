<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role_id' => Role::factory(),
            'name' => $this->faker->word(),
            'url' => '/' . $this->faker->slug(),
        ];
    }
}
