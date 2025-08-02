<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Software Developer',
                'description' => 'Kandidat untuk posisi pengembang perangkat lunak',
                'color' => '#3B82F6',
                'is_active' => true,
            ],
            [
                'name' => 'Data Analyst',
                'description' => 'Kandidat untuk posisi analis data',
                'color' => '#10B981',
                'is_active' => true,
            ],
            [
                'name' => 'UI/UX Designer',
                'description' => 'Kandidat untuk posisi desainer UI/UX',
                'color' => '#F59E0B',
                'is_active' => true,
            ],
            [
                'name' => 'Project Manager',
                'description' => 'Kandidat untuk posisi manajer proyek',
                'color' => '#EF4444',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing Specialist',
                'description' => 'Kandidat untuk posisi spesialis pemasaran',
                'color' => '#8B5CF6',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
