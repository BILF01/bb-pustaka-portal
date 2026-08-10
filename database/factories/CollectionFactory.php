<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\CollectionCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollectionFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'collection_category_id' => CollectionCategory::factory(),
            'title' => rtrim($title, '.'),
            'slug' => Str::slug($title).'-'.fake()->unique()->randomNumber(5),
            'author' => fake()->name(),
            'publisher' => 'Kementerian Pertanian RI',
            'published_year' => fake()->numberBetween(2015, 2025),
            'isbn' => fake()->isbn13(),
            'synopsis' => fake()->paragraph(),
            'cover_path' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&q=80',
            'page_count' => fake()->numberBetween(50, 300).' halaman',
            'access_link' => 'https://repository.pertanian.go.id/handle/123456789/'.fake()->numberBetween(1000, 9999),
            'is_featured' => fake()->boolean(30),
        ];
    }
}