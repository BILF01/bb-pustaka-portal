<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollectionCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement([
            'Pertanian Modern',
            'Sistem Pangan',
            'Kesehatan Tanah',
            'Precision Farming',
            'Perkebunan Tropis',
            'Peternakan',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->randomNumber(4),
        ];
    }
}