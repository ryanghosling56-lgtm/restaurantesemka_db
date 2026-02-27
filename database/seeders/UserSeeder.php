<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    public function run(): void
    {
         \App\Models\User::factory()->create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),

    ]);
    }
}
