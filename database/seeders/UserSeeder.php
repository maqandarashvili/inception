<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'admin',
        ]);

        for ($i = 1; $i <= 10; $i++) {
            User::create([
                'first_name' => "test$i",
                'last_name' => "person$i",
                'email' => "testPlayer$i@gmail.com",
                'password' => Hash::make("password$i"),
                'role' => 'player',
            ]);
        }
    }
}
