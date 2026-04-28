<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Follow;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Follow::create([
        'follower_id' => 2,
        'following_id' => 1,
        ]);

        Follow::create([
            'follower_id' => 3,
            'following_id' => 1,
        ]);

        Follow::create([
            'follower_id' => 1,
            'following_id' => 2,
        ]);
    }
}
