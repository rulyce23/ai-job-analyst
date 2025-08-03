<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ahmad Rizki Perdana',
                'email' => 'ahmad.rizki@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'company_name' => null,
            ],
                   [
                'name' => 'Admin',
                'email' => 'admin123@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'company_name' => "PT Hacktiv8",
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'company_name' => null,
            ],
            [
                'name' => 'Citra Dewi',
                'email' => 'citra.dewi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'company_name' => null,
            ],
            // Add more users as needed
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
