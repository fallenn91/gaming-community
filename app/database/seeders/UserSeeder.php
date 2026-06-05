<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Achievement;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
        'name' => 'Admin',
        'username' => 'admin',
        'role_id' => 1,
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'reputation' => 9999,
        'level' => 999,
        'xp' => 9999,
        'bio' => 'Administrador de la comunidad',
        'is_online' => true,
        'email_verified_at' => now(),
      ]);

      User::create([
          'name' => 'Player One',
          'username' => 'player1',
          'role_id' => 3,
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
          'role_id' => 3,
          'email' => 'ggirl@test.com',
          'password' => Hash::make('password'),
          'level' => 7,
          'xp' => 1800,
          'bio' => 'LoL main 🧠',
          'is_online' => false,
      ]);

      $achievements = Achievement::all();

        foreach ($achievements as $achievement) {
            $admin->achievements()->syncWithoutDetaching([
                $achievement->id => [
                    'unlocked_at' => now(),
                ]
            ]);
        }
    }
    
}
