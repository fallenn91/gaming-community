<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Achievement;

class AchievementSeeder extends Seeder
{
    public function run(): void
    {
        Achievement::insert([

            [
                'name' => 'First Post',
                'type' => 'posts',
                'threshold' => 1,
                'xp_reward' => 10,
            ],
            [
                'name' => 'Content Creator',
                'type' => 'posts',
                'threshold' => 10,
                'xp_reward' => 50,
            ],
            [
                'name' => 'Prolific Writer',
                'type' => 'posts',
                'threshold' => 50,
                'xp_reward' => 150,
            ],

            [
                'name' => 'Liked!',
                'type' => 'likes_received',
                'threshold' => 10,
                'xp_reward' => 20,
            ],
            [
                'name' => 'Popular Post',
                'type' => 'likes_received',
                'threshold' => 100,
                'xp_reward' => 100,
            ],

            [
                'name' => 'Getting Followers',
                'type' => 'followers_received',
                'threshold' => 5,
                'xp_reward' => 20,
            ],
            [
                'name' => 'Influencer',
                'type' => 'followers_received',
                'threshold' => 50,
                'xp_reward' => 200,
            ],

            [
                'name' => 'Social Starter',
                'type' => 'follows',
                'threshold' => 5,
                'xp_reward' => 10,
            ],
            [
                'name' => 'Network Builder',
                'type' => 'follows',
                'threshold' => 20,
                'xp_reward' => 50,
            ],

            [
                'name' => 'First Comment',
                'type' => 'comments',
                'threshold' => 1,
                'xp_reward' => 5,
            ],
            [
                'name' => 'Conversationalist',
                'type' => 'comments',
                'threshold' => 25,
                'xp_reward' => 80,
            ],

            [
                'name' => 'Rising Star',
                'type' => 'reputation',
                'threshold' => 100,
                'xp_reward' => 50,
            ],
            [
                'name' => 'Legend',
                'type' => 'reputation',
                'threshold' => 1000,
                'xp_reward' => 500,
            ],

        ]);
    }
}