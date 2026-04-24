<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Game;


class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::create([
        'name' => 'Valorant',
        'slug' => 'valorant',
        'cover' => 'valorant.jpg',
        ]);

        Game::create([
            'name' => 'League of Legends',
            'slug' => 'league-of-legends',
            'cover' => 'lol.jpg',
        ]);

        Game::create([
            'name' => 'Minecraft',
            'slug' => 'minecraft',
            'cover' => 'minecraft.jpg',
        ]);

        Game::create([
            'name' => 'CS2',
            'slug' => 'cs2',
            'cover' => 'cs2.jpg',
        ]);
    }
}
