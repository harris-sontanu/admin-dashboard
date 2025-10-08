<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insert([
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'user',
                'email' => 'aldynuada132@gmail.com',
                'password' => bcrypt('password123'),
            ],
        ]);
    }
}
