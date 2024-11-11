<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Issue>
 */
class IssueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'reporter' => $this->faker->name,
            'tester' => $this->faker->name,
            'executor' => $this->faker->name,
            'status' => $this->faker->randomElement([1, 2, 3, 4]),
            'type' => $this->faker->randomElement([1, 2]),
        ];
    }
}
