<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Role;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'username' => fake()->unique()->userName(),

            'role_id' => Role::factory(), // User por defecto (según tu migración)

            'email' => fake()->unique()->safeEmail(),

            'email_verified_at' => now(),

            'password' => static::$password ??= Hash::make('password'),

            'avatar' => null,
            'banner' => null,
            'bio' => fake()->optional()->sentence(),

            'level' => 1,
            'xp' => 0,
            'reputation' => 0,

            'followers_count' => 0,
            'following_count' => 0,

            'is_online' => true,
            'last_seen' => now(),

            'can_create_communities' => false,

            'remember_token' => Str::random(10),
        ];
    }
}
