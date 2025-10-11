<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DataNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->dataCategory();
        $this->dataPost();
    }

    public function dataCategory()
    {
        $categories = [
            'Politics',
            'Economy',
            'Technology',
            'Entertainment',
            'Sports',
            'Health',
            'Lifestyle',
            'Education',
            'Environment',
            'World',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => fake()->paragraphs(rand(2, 4), true),
            ]);
        }
    }

    public function dataPost()
    {
        $categoryIds = Category::pluck('id')->all();

        Post::factory()->count(20)
            ->state(function () use ($categoryIds) {
                return [
                    'category_id' => fake()->randomElement($categoryIds),
                ];
            })
            ->create();
    }
}
