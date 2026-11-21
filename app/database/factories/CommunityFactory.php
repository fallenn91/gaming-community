<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommunityFactory extends Factory
{
    protected $model = Community::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'game_id' => null,
            'owner_id' => User::factory(),
            'level' => 1,
            'xp' => 0,
            'rank' => 'Bronze',
            'slug' => $this->faker->unique()->slug(),
            'visibility' => 'public',
            'status' => 'active',
            'description' => $this->faker->sentence(),
            'image' => null,
        ];
    }
}
