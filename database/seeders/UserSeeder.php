<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Guru',
                'email' => 'guru@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'guru',
            ]
        ]);
    }
}
