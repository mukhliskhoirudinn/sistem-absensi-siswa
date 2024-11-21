<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Teacher::insert([
            [
                'user_id' => 2,
                'nip' => '22312008',
                'name' => 'Mukhlis Khoirudin, S.Kom.',
                'address' => 'Bandar Lampung',
                'phone' => '081234567890',
                'email' => 'muklis@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
