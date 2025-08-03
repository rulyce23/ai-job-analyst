<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Category;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users to assign user_id in candidates
        $users = User::all();
        
        // Create candidates for each user
        foreach ($users as $user) {
            Candidate::updateOrCreate(
                [
                    'email' => $user->email,
                ],
                [
                    'category_id' => rand(1, 5), // Assuming 5 categories exist
                    'user_id' => $user->id,
                    'company_name' => $user->company_name,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => '08' . rand(1000000000, 9999999999),
                    'education_level' => ['SMA', 'D3', 'S1', 'S2', 'S3'][array_rand(['SMA', 'D3', 'S1', 'S2', 'S3'])],
                    'field_of_study' => ['Computer Science', 'Information Systems', 'Business Administration', 'Engineering', 'Mathematics'][array_rand(['Computer Science', 'Information Systems', 'Business Administration', 'Engineering', 'Mathematics'])],
                    'years_of_experience' => rand(0, 20),
                    'expected_salary' => rand(3000000, 15000000),
                    'preferred_location' => ['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Medan'][array_rand(['Jakarta', 'Bandung', 'Surabaya', 'Yogyakarta', 'Medan'])],
                    'work_type_preference' => ['Remote', 'Hybrid', 'On-site'][array_rand(['Remote', 'Hybrid', 'On-site'])],
                    'reason' => 'I am a good fit for this role.',
                    'status' => 'pending',
                    'applied_at' => now(),
                ]
            );
        }
    }
}
