<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobRole;
use App\Models\Skill;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobRoles = [
            [
                'title' => 'Full Stack Developer',
                'description' => 'Mengembangkan aplikasi web end-to-end menggunakan teknologi modern. Bertanggung jawab untuk frontend dan backend development.',
                'category' => 'IT',
                'level' => 'Mid',
                'min_salary' => 8000000,
                'max_salary' => 15000000,
                'min_experience_years' => 2,
                'responsibilities' => "• Mengembangkan aplikasi web responsif\n• Membuat API dan integrasi database\n• Kolaborasi dengan tim design dan product\n• Maintenance dan debugging aplikasi",
                'requirements' => "• Minimal 2 tahun pengalaman web development\n• Menguasai JavaScript, HTML, CSS\n• Pengalaman dengan framework modern (React/Vue)\n• Familiar dengan database dan API development",
                'work_type' => 'hybrid',
                'skills' => ['JavaScript', 'HTML', 'CSS', 'React', 'Node.js', 'MySQL', 'PHP']
            ],
            [
                'title' => 'Frontend Developer',
                'description' => 'Spesialis dalam pengembangan antarmuka pengguna yang menarik dan responsif menggunakan teknologi frontend terkini.',
                'category' => 'IT',
                'level' => 'Entry',
                'min_salary' => 5000000,
                'max_salary' => 10000000,
                'min_experience_years' => 1,
                'responsibilities' => "• Membuat UI/UX yang user-friendly\n• Implementasi design ke dalam kode\n• Optimasi performa aplikasi web\n• Testing dan debugging frontend",
                'requirements' => "• Minimal 1 tahun pengalaman frontend\n• Menguasai HTML, CSS, JavaScript\n• Pengalaman dengan React atau Vue.js\n• Pemahaman tentang responsive design",
                'work_type' => 'remote',
                'skills' => ['JavaScript', 'HTML', 'CSS', 'React', 'UI/UX Design', 'Figma']
            ],
            [
                'title' => 'Backend Developer',
                'description' => 'Mengembangkan dan memelihara sistem backend, API, dan database untuk mendukung aplikasi web dan mobile.',
                'category' => 'IT',
                'level' => 'Mid',
                'min_salary' => 7000000,
                'max_salary' => 13000000,
                'min_experience_years' => 2,
                'responsibilities' => "• Mengembangkan API dan web services\n• Mengelola database dan optimasi query\n• Implementasi security dan authentication\n• Monitoring dan maintenance server",
                'requirements' => "• Minimal 2 tahun pengalaman backend development\n• Menguasai PHP, Python, atau Java\n• Pengalaman dengan database (MySQL/PostgreSQL)\n• Familiar dengan cloud services",
                'work_type' => 'hybrid',
                'skills' => ['PHP', 'Python', 'MySQL', 'Laravel', 'AWS', 'Docker']
            ],
            [
                'title' => 'Data Scientist',
                'description' => 'Menganalisis data kompleks untuk menghasilkan insights bisnis dan mengembangkan model machine learning.',
                'category' => 'Data',
                'level' => 'Mid',
                'min_salary' => 10000000,
                'max_salary' => 20000000,
                'min_experience_years' => 2,
                'responsibilities' => "• Analisis data dan statistical modeling\n• Pengembangan machine learning models\n• Data visualization dan reporting\n• Kolaborasi dengan tim bisnis untuk insights",
                'requirements' => "• Minimal 2 tahun pengalaman data science\n• Menguasai Python dan statistical analysis\n• Pengalaman dengan ML frameworks\n• Strong analytical dan problem-solving skills",
                'work_type' => 'hybrid',
                'skills' => ['Python', 'Machine Learning', 'Data Analysis', 'TensorFlow', 'Problem Solving']
            ],
            [
                'title' => 'Mobile Developer',
                'description' => 'Mengembangkan aplikasi mobile untuk platform iOS dan Android menggunakan teknologi cross-platform atau native.',
                'category' => 'IT',
                'level' => 'Mid',
                'min_salary' => 8000000,
                'max_salary' => 15000000,
                'min_experience_years' => 2,
                'responsibilities' => "• Pengembangan aplikasi mobile\n• Integrasi dengan API dan backend services\n• Testing dan debugging aplikasi\n• Publikasi ke app stores",
                'requirements' => "• Minimal 2 tahun pengalaman mobile development\n• Menguasai React Native atau Flutter\n• Pengalaman dengan native development (iOS/Android)\n• Familiar dengan mobile UI/UX principles",
                'work_type' => 'remote',
                'skills' => ['React Native', 'Flutter', 'JavaScript', 'iOS Development', 'Android Development']
            ],
            [
                'title' => 'DevOps Engineer',
                'description' => 'Mengelola infrastruktur cloud, CI/CD pipeline, dan automation untuk mendukung development dan deployment.',
                'category' => 'IT',
                'level' => 'Senior',
                'min_salary' => 12000000,
                'max_salary' => 25000000,
                'min_experience_years' => 3,
                'responsibilities' => "• Mengelola cloud infrastructure\n• Setup CI/CD pipelines\n• Monitoring dan logging systems\n• Security dan compliance management",
                'requirements' => "• Minimal 3 tahun pengalaman DevOps\n• Menguasai Docker, Kubernetes\n• Pengalaman dengan AWS/GCP/Azure\n• Strong automation dan scripting skills",
                'work_type' => 'hybrid',
                'skills' => ['Docker', 'Kubernetes', 'AWS', 'Python', 'Problem Solving']
            ],
            [
                'title' => 'UI/UX Designer',
                'description' => 'Merancang pengalaman pengguna yang intuitif dan antarmuka yang menarik untuk aplikasi web dan mobile.',
                'category' => 'Design',
                'level' => 'Mid',
                'min_salary' => 6000000,
                'max_salary' => 12000000,
                'min_experience_years' => 2,
                'responsibilities' => "• User research dan usability testing\n• Wireframing dan prototyping\n• Visual design dan branding\n• Kolaborasi dengan development team",
                'requirements' => "• Minimal 2 tahun pengalaman UI/UX design\n• Menguasai Figma, Adobe Creative Suite\n• Portfolio yang strong\n• Pemahaman tentang user-centered design",
                'work_type' => 'hybrid',
                'skills' => ['UI/UX Design', 'Figma', 'Adobe Creative Suite', 'Communication', 'Problem Solving']
            ],
            [
                'title' => 'Project Manager',
                'description' => 'Mengelola proyek teknologi dari perencanaan hingga delivery, memastikan timeline dan kualitas terpenuhi.',
                'category' => 'Management',
                'level' => 'Senior',
                'min_salary' => 10000000,
                'max_salary' => 18000000,
                'min_experience_years' => 3,
                'responsibilities' => "• Project planning dan resource allocation\n• Team coordination dan communication\n• Risk management dan problem solving\n• Stakeholder management dan reporting",
                'requirements' => "• Minimal 3 tahun pengalaman project management\n• Sertifikasi PMP atau Agile/Scrum\n• Strong leadership dan communication skills\n• Pengalaman dengan project management tools",
                'work_type' => 'onsite',
                'skills' => ['Project Management', 'Leadership', 'Communication', 'Problem Solving']
            ]
        ];

        foreach ($jobRoles as $jobRoleData) {
            $skills = $jobRoleData['skills'];
            unset($jobRoleData['skills']);
            
            $jobRole = JobRole::create($jobRoleData);
            
            // Attach skills to job role
            foreach ($skills as $skillName) {
                $skill = Skill::where('name', $skillName)->first();
                if ($skill) {
                    $jobRole->skills()->attach($skill->id, [
                        'importance_level' => rand(3, 5),
                        'min_proficiency_level' => rand(2, 4)
                    ]);
                }
            }
        }
    }
}
