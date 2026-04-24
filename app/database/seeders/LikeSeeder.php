<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Like::create(['user_id' => 2, 'post_id' => 1]);
        Like::create(['user_id' => 3, 'post_id' => 1]);

        Like::create(['user_id' => 1, 'post_id' => 2]);
        Like::create(['user_id' => 3, 'post_id' => 2]);

        Like::create(['user_id' => 1, 'post_id' => 3]);
    }
}
