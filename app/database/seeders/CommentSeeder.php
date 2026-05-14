<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::create([
        'user_id' => 2,
        'post_id' => 1,
        'content' => 'GG 🔥',
        ]);

        Comment::create([
            'user_id' => 3,
            'post_id' => 1,
            'content' => 'Nice community!',
        ]);

        Comment::create([
            'user_id' => 1,
            'post_id' => 2,
            'content' => 'Yo me apunto',
        ]);
    }
}
