<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 1, // Admin
            ],
            [
                'name' => 'Guru User',
                'email' => 'guru@example.com',
                'password' => Hash::make('password'),
                'role' => 2, // Guru
            ],
            [
                'name' => 'Murid User',
                'email' => 'murid@example.com',
                'password' => Hash::make('password'),
                'role' => 3, // Murid
            ],
            [
                'name' => 'Orang Tua User',
                'email' => 'orangtua@example.com',
                'password' => Hash::make('password'),
                'role' => 4, // Orang Tua
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
