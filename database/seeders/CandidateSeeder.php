<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Candidate;
use App\Models\Category;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        $candidates = [
            [
                'category_id' => $categories->where('name', 'Software Developer')->first()->id,
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@email.com',
                'phone' => '081234567890',
                'address' => 'Jakarta Selatan',
                'birth_date' => '1995-05-15',
                'education_level' => 'S1',
                'field_of_study' => 'Teknik Informatika',
                'years_of_experience' => 3,
                'skills' => ['PHP', 'Laravel', 'JavaScript', 'MySQL', 'Git'],
                'reason' => 'Saya adalah seorang software developer dengan pengalaman 3 tahun dalam pengembangan web menggunakan PHP dan Laravel. Saya memiliki passion dalam menciptakan solusi teknologi yang inovatif.',
                'expected_salary' => 10000000,
                'preferred_location' => 'Jakarta',
                'work_type_preference' => 'hybrid',
                'status' => 'pending',
            ],
            [
                'category_id' => $categories->where('name', 'Data Analyst')->first()->id,
                'name' => 'Sari Dewi',
                'email' => 'sari.dewi@email.com',
                'phone' => '081234567891',
                'address' => 'Bandung',
                'birth_date' => '1993-08-22',
                'education_level' => 'S1',
                'field_of_study' => 'Statistika',
                'years_of_experience' => 4,
                'skills' => ['Python', 'SQL', 'Tableau', 'Excel', 'R'],
                'reason' => 'Saya memiliki pengalaman 4 tahun sebagai data analyst dengan keahlian dalam menganalisis data dan membuat visualisasi yang informatif untuk mendukung pengambilan keputusan bisnis.',
                'expected_salary' => 11000000,
                'preferred_location' => 'Bandung',
                'work_type_preference' => 'remote',
                'status' => 'pending',
            ],
            [
                'category_id' => $categories->where('name', 'UI/UX Designer')->first()->id,
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'phone' => '081234567892',
                'address' => 'Surabaya',
                'birth_date' => '1996-03-10',
                'education_level' => 'S1',
                'field_of_study' => 'Desain Komunikasi Visual',
                'years_of_experience' => 2,
                'skills' => ['Figma', 'Adobe XD', 'Sketch', 'Photoshop', 'Illustrator'],
                'reason' => 'Saya adalah UI/UX Designer dengan 2 tahun pengalaman dalam merancang interface yang user-friendly dan menarik. Saya selalu mengutamakan user experience dalam setiap desain yang saya buat.',
                'expected_salary' => 8500000,
                'preferred_location' => 'Surabaya',
                'work_type_preference' => 'hybrid',
                'status' => 'pending',
            ],
            [
                'category_id' => $categories->where('name', 'Project Manager')->first()->id,
                'name' => 'Lisa Permata',
                'email' => 'lisa.permata@email.com',
                'phone' => '081234567893',
                'address' => 'Jakarta Pusat',
                'birth_date' => '1990-12-05',
                'education_level' => 'S1',
                'field_of_study' => 'Manajemen',
                'years_of_experience' => 6,
                'skills' => ['Project Management', 'Scrum', 'Agile', 'JIRA', 'Leadership'],
                'reason' => 'Dengan pengalaman 6 tahun sebagai project manager, saya telah berhasil mengelola berbagai proyek IT dari tahap perencanaan hingga implementasi dengan metodologi Agile dan Scrum.',
                'expected_salary' => 17500000,
                'preferred_location' => 'Jakarta',
                'work_type_preference' => 'onsite',
                'status' => 'approved',
            ],
            [
                'category_id' => $categories->where('name', 'Marketing Specialist')->first()->id,
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@email.com',
                'phone' => '081234567894',
                'address' => 'Yogyakarta',
                'birth_date' => '1994-07-18',
                'education_level' => 'S1',
                'field_of_study' => 'Komunikasi',
                'years_of_experience' => 3,
                'skills' => ['Digital Marketing', 'SEO', 'Google Ads', 'Social Media', 'Content Writing'],
                'reason' => 'Saya adalah marketing specialist dengan fokus pada digital marketing. Pengalaman 3 tahun saya mencakup SEO, SEM, social media marketing, dan content creation untuk berbagai brand.',
                'expected_salary' => 7500000,
                'preferred_location' => 'Yogyakarta',
                'work_type_preference' => 'remote',
                'status' => 'pending',
            ],
        ];

        foreach ($candidates as $candidate) {
            Candidate::create($candidate);
        }
    }
}
