<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Moderator'],
            ['name' => 'Gamer'],
            ['name' => 'Streamer'],
            ['name' => 'Content Creator'],
            ['name' => 'Clan Leader'],
            ['name' => 'Member'],
            ['name' => 'Guest'],
            ['name' => 'Banned'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
}
