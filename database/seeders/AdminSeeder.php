<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin users with company_name to match candidates
        $admins = [
            [
                'name' => 'Admin Company A',
                'email' => 'adminA@example.com',
                'password' => Hash::make('password123'),
                'company_name' => 'Company A',
            ],
            [
                'name' => 'Admin Company B',
                'email' => 'adminB@example.com',
                'password' => Hash::make('password123'),
                'company_name' => 'Company B',
            ],
            // Add more admins as needed
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => $admin['password'],
                    'company_name' => $admin['company_name'],
                ]
            );
        }
    }
}
