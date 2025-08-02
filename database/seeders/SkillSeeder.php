<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            // Programming Languages
            ['name' => 'PHP', 'category' => 'Programming', 'description' => 'Server-side scripting language', 'demand_level' => 4],
            ['name' => 'JavaScript', 'category' => 'Programming', 'description' => 'Client-side and server-side programming', 'demand_level' => 5],
            ['name' => 'Python', 'category' => 'Programming', 'description' => 'General-purpose programming language', 'demand_level' => 5],
            ['name' => 'Java', 'category' => 'Programming', 'description' => 'Object-oriented programming language', 'demand_level' => 4],
            ['name' => 'C#', 'category' => 'Programming', 'description' => 'Microsoft .NET programming language', 'demand_level' => 3],
            ['name' => 'Go', 'category' => 'Programming', 'description' => 'Google programming language', 'demand_level' => 3],
            ['name' => 'Rust', 'category' => 'Programming', 'description' => 'Systems programming language', 'demand_level' => 2],
            
            // Web Development
            ['name' => 'HTML', 'category' => 'Web Development', 'description' => 'Markup language for web pages', 'demand_level' => 4],
            ['name' => 'CSS', 'category' => 'Web Development', 'description' => 'Styling language for web pages', 'demand_level' => 4],
            ['name' => 'React', 'category' => 'Web Development', 'description' => 'JavaScript library for building UIs', 'demand_level' => 5],
            ['name' => 'Vue.js', 'category' => 'Web Development', 'description' => 'Progressive JavaScript framework', 'demand_level' => 4],
            ['name' => 'Angular', 'category' => 'Web Development', 'description' => 'TypeScript-based web framework', 'demand_level' => 3],
            ['name' => 'Laravel', 'category' => 'Web Development', 'description' => 'PHP web application framework', 'demand_level' => 4],
            ['name' => 'Node.js', 'category' => 'Web Development', 'description' => 'JavaScript runtime environment', 'demand_level' => 4],
            
            // Database
            ['name' => 'MySQL', 'category' => 'Database', 'description' => 'Relational database management system', 'demand_level' => 4],
            ['name' => 'PostgreSQL', 'category' => 'Database', 'description' => 'Advanced relational database', 'demand_level' => 3],
            ['name' => 'MongoDB', 'category' => 'Database', 'description' => 'NoSQL document database', 'demand_level' => 3],
            ['name' => 'Redis', 'category' => 'Database', 'description' => 'In-memory data structure store', 'demand_level' => 3],
            
            // DevOps & Cloud
            ['name' => 'Docker', 'category' => 'DevOps', 'description' => 'Containerization platform', 'demand_level' => 4],
            ['name' => 'Kubernetes', 'category' => 'DevOps', 'description' => 'Container orchestration platform', 'demand_level' => 3],
            ['name' => 'AWS', 'category' => 'Cloud', 'description' => 'Amazon Web Services cloud platform', 'demand_level' => 5],
            ['name' => 'Google Cloud', 'category' => 'Cloud', 'description' => 'Google Cloud Platform', 'demand_level' => 3],
            ['name' => 'Azure', 'category' => 'Cloud', 'description' => 'Microsoft Azure cloud platform', 'demand_level' => 3],
            
            // Data Science & AI
            ['name' => 'Machine Learning', 'category' => 'Data Science', 'description' => 'AI and ML algorithms', 'demand_level' => 5],
            ['name' => 'Data Analysis', 'category' => 'Data Science', 'description' => 'Statistical data analysis', 'demand_level' => 4],
            ['name' => 'TensorFlow', 'category' => 'Data Science', 'description' => 'Machine learning framework', 'demand_level' => 3],
            ['name' => 'PyTorch', 'category' => 'Data Science', 'description' => 'Deep learning framework', 'demand_level' => 3],
            
            // Mobile Development
            ['name' => 'React Native', 'category' => 'Mobile', 'description' => 'Cross-platform mobile development', 'demand_level' => 4],
            ['name' => 'Flutter', 'category' => 'Mobile', 'description' => 'Google mobile UI framework', 'demand_level' => 4],
            ['name' => 'iOS Development', 'category' => 'Mobile', 'description' => 'Native iOS app development', 'demand_level' => 3],
            ['name' => 'Android Development', 'category' => 'Mobile', 'description' => 'Native Android app development', 'demand_level' => 3],
            
            // Soft Skills
            ['name' => 'Project Management', 'category' => 'Soft Skills', 'description' => 'Managing projects and teams', 'demand_level' => 4],
            ['name' => 'Communication', 'category' => 'Soft Skills', 'description' => 'Effective communication skills', 'demand_level' => 5],
            ['name' => 'Leadership', 'category' => 'Soft Skills', 'description' => 'Team leadership abilities', 'demand_level' => 4],
            ['name' => 'Problem Solving', 'category' => 'Soft Skills', 'description' => 'Analytical problem-solving skills', 'demand_level' => 5],
            
            // Design
            ['name' => 'UI/UX Design', 'category' => 'Design', 'description' => 'User interface and experience design', 'demand_level' => 4],
            ['name' => 'Figma', 'category' => 'Design', 'description' => 'Design and prototyping tool', 'demand_level' => 4],
            ['name' => 'Adobe Creative Suite', 'category' => 'Design', 'description' => 'Adobe design tools', 'demand_level' => 3],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
