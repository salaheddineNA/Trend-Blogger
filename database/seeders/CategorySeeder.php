<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Tech', 'slug' => 'tech', 'description' => 'Technology news and tutorials', 'color' => '#007bff'],
            ['name' => 'Food', 'slug' => 'food', 'description' => 'Recipes and food reviews', 'color' => '#28a745'],
            ['name' => 'News', 'slug' => 'news', 'description' => 'Latest news and updates', 'color' => '#dc3545'],
            ['name' => 'Travel', 'slug' => 'travel', 'description' => 'Travel guides and experiences', 'color' => '#ffc107'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Lifestyle tips and trends', 'color' => '#6f42c1'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
