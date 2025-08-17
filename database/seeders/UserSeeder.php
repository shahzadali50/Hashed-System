<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {
        // Create a default admin user
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);

        // Create 9 additional users
        $users = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.anderson@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'robert.taylor@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez@example.com',
                'password' => Hash::make('12345678'),

            ],
            [
                'name' => 'Christopher Garcia',
                'email' => 'christopher.garcia@example.com',
                'password' => Hash::make('12345678'),

            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
