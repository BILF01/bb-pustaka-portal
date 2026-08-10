<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'news_category_id' => NewsCategory::factory(),
            'title' => $title,
            'slug' => Str::slug($title).'-'.fake()->unique()->randomNumber(5),
            'excerpt' => fake()->sentence(20),
            'body' => implode("\n\n", fake()->paragraphs(5)),
            'image_path' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800&q=80',
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-2 months', 'now'),
        ];
    }
}