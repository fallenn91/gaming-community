<?php

namespace Database\Factories;

use App\Models\achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<achievement>
 */
class AchievementFactory extends Factory
{
    protected $model = Achievement::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['posts', 'likes', 'time_spent'];

        return [
            'name' => fake()->unique()->words(2, true),

            'type' => fake()->randomElement($types),

            'threshold' => fake()->numberBetween(1, 1000),

            'xp_reward' => fake()->numberBetween(0, 500),
        
        ];
    }

    public function posts(): static
    {
        return $this->state(fn () => [
            'type' => 'posts',
        ]);
    }

    public function likes(): static
    {
        return $this->state(fn () => [
            'type' => 'likes',
        ]);
    }

    public function timeSpent(): static
    {
        return $this->state(fn () => [
            'type' => 'time_spent',
        ]);
    }
}
