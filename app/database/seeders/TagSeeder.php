<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'gaming',
            'ai',
            'dev',
            'indie',
            'rpg',
            'mmo',
            'battle-royale',
            'esports',
            'streaming',
            'twitch',
            'cyberpunk',
            'retro',
            'pixel-art',
            'multiplayer',
        ];

        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'created_at' => now(),
            ]);
        }
    }
}
