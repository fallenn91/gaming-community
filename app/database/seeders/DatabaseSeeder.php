<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
          RoleSeeder::class,
          AchievementSeeder::class,
          UserSeeder::class,
          GameSeeder::class,
          PostSeeder::class,
          LikeSeeder::class,
          CommentSeeder::class,
          FollowSeeder::class,
          RoleSeeder::class,
          TagSeeder::class,
        ]);
    }
}
