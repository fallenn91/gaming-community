<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Admin',
        'username' => 'admin',
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'level' => 10,
        'xp' => 9999,
        'bio' => 'Administrador de la comunidad',
        'is_online' => true,
      ]);

      User::create([
          'name' => 'Player One',
          'username' => 'player1',
          'email' => 'player1@test.com',
          'password' => Hash::make('password'),
          'level' => 5,
          'xp' => 1200,
          'bio' => 'FPS enjoyer 🔫',
          'is_online' => true,
      ]);

      User::create([
          'name' => 'Gamer Girl',
          'username' => 'ggirl',
          'email' => 'ggirl@test.com',
          'password' => Hash::make('password'),
          'level' => 7,
          'xp' => 1800,
          'bio' => 'LoL main 🧠',
          'is_online' => false,
      ]);
    }
}
