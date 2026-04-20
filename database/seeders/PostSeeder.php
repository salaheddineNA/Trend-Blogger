<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first() ?: User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $posts = [
            [
                'title' => 'Getting Started with Laravel 10',
                'slug' => 'getting-started-laravel-10',
                'excerpt' => 'Learn the basics of Laravel 10 and build your first application.',
                'content' => 'Laravel 10 is the latest version of the popular PHP framework. In this comprehensive guide, we will walk you through setting up your development environment, creating your first Laravel project, and understanding the fundamental concepts that make Laravel so powerful.

From routing to database migrations, from Eloquent ORM to Blade templating, this article covers everything you need to know to get started with modern Laravel development. Whether you are a beginner or an experienced developer looking to refresh your knowledge, this guide has something for everyone.

We will also explore some of the new features introduced in Laravel 10, including improved performance, new helper functions, and enhanced developer experience.',
                'category_slug' => 'tech',
            ],
            [
                'title' => '10 Easy Recipes for Busy Weeknights',
                'slug' => 'easy-recipes-busy-weeknights',
                'excerpt' => 'Quick and delicious meals you can prepare in under 30 minutes.',
                'content' => 'We all know the struggle of coming home after a long day and having to figure out what to make for dinner. That is why I have compiled this list of 10 easy recipes that you can prepare in under 30 minutes.

From one-pan pasta dishes to quick stir-fries, these recipes are designed to save you time without sacrificing flavor. Each recipe uses simple ingredients that you likely already have in your pantry, and most can be customized based on your dietary preferences.

Whether you are cooking for one or feeding a family, these weeknight-friendly recipes will help you get a delicious meal on the table quickly and easily.',
                'category_slug' => 'food',
            ],
            [
                'title' => 'Breaking: Major Tech Acquisition Announced',
                'slug' => 'major-tech-acquisition-announced',
                'excerpt' => 'Tech giant announces multi-billion dollar acquisition of startup company.',
                'content' => 'In a move that is shaking up the technology industry, a major tech company announced today that it will be acquiring a promising startup for a reported $5 billion. The acquisition is expected to close by the end of the year, pending regulatory approval.

The startup, which has been gaining traction in the artificial intelligence space, has developed innovative machine learning algorithms that could significantly enhance the acquiring company\'s product offerings. Industry experts believe this acquisition could lead to major advancements in AI technology and consumer applications.

Both companies have expressed optimism about the deal, with executives citing shared values and complementary technologies as key factors in the decision.',
                'category_slug' => 'news',
            ],
            [
                'title' => 'Hidden Gems: Exploring Southeast Asia',
                'slug' => 'hidden-gems-southeast-asia',
                'excerpt' => 'Discover the most beautiful and underrated destinations in Southeast Asia.',
                'content' => 'Southeast Asia is home to some of the world\'s most stunning landscapes, vibrant cultures, and delicious cuisines. While many tourists flock to popular destinations like Bangkok and Bali, there are countless hidden gems waiting to be discovered.

From the pristine beaches of the Philippines to the ancient temples of Myanmar, this guide will take you off the beaten path to explore places that most tourists never see. Learn about local customs, try authentic street food, and experience the true beauty of Southeast Asia.

Whether you are an adventure seeker, a culture enthusiast, or simply looking for a relaxing getaway, these hidden gems offer something for every type of traveler.',
                'category_slug' => 'travel',
            ],
            [
                'title' => 'Mindfulness in the Digital Age',
                'slug' => 'mindfulness-digital-age',
                'excerpt' => 'How to stay present and mindful in our constantly connected world.',
                'content' => 'In today\'s fast-paced digital world, it can be challenging to stay present and mindful. With constant notifications, social media updates, and the pressure to always be available, our minds are often pulled in multiple directions.

This article explores practical strategies for incorporating mindfulness into your daily routine, even when surrounded by technology. From digital detox techniques to mindful breathing exercises, these practices can help you reduce stress, improve focus, and enhance your overall well-being.

Learn how to create healthy boundaries with technology, practice digital minimalism, and cultivate a more mindful approach to life in the digital age.',
                'category_slug' => 'lifestyle',
            ],
        ];

        foreach ($posts as $postData) {
            $category = Category::where('slug', $postData['category_slug'])->first();
            
            Post::create([
                'title' => $postData['title'],
                'slug' => $postData['slug'],
                'excerpt' => $postData['excerpt'],
                'content' => $postData['content'],
                'category_id' => $category->id,
                'user_id' => $user->id,
                'is_published' => true,
                'published_at' => now()->subDays(rand(1, 30)),
                'views' => rand(50, 500),
            ]);
        }
    }
}
