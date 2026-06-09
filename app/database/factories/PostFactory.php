<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'content' => fake()->paragraph(),

            'image' => fake()->optional()->imageUrl(640, 480, 'social'),
        ];
    }

    public function withoutImage(): static
    {
        return $this->state(fn () => [
            'image' => null,
        ]);
    }
}
