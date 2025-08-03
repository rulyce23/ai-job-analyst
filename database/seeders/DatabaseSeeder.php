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
        // Seed skills and categories first
        $this->call([
            SkillSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            JobRoleSeeder::class,
            CandidateSeeder::class,
        ]);

        // Create test user
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
