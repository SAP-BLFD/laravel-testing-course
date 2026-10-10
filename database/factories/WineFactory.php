<?php

namespace Database\Factories;

use App\Models\Wine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Wine>
 */
class WineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'color' => $this->faker->randomElement(['red', 'white']),
            'user_id' => User::factory(),
        ];
    }
}
