<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::create([
        'user_id' => 1,
        'content' => 'Bienvenidos a la comunidad 🚀',
        ]);

        Post::create([
            'user_id' => 2,
            'content' => 'Busco duo para ranked 🔥',
        ]);

        Post::create([
            'user_id' => 3,
            'content' => 'Hoy stream de LoL 😎',
        ]);

        Post::create([
            'user_id' => 1,
            'content' => 'Nuevo sistema de levels añadido ⚡',
        ]);
    }
}
