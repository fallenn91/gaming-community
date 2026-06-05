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
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Moderator'],
            ['id' => 3, 'name' => 'Gamer'],
            ['id' => 4, 'name' => 'Streamer'],
            ['id' => 5, 'name' => 'Content Creator'],
            ['id' => 6, 'name' => 'Clan Leader'],
            ['id' => 7, 'name' => 'Member'],
            ['id' => 8, 'name' => 'Guest'],
            ['id' => 9, 'name' => 'Banned'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['id' => $role['id']],
                ['name' => $role['name']]
            );
        }
    }
}
