<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NewsCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement(['Inovasi', 'Event', 'Pengumuman', 'Riset', 'Kolaborasi']);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->randomNumber(4),
        ];
    }
}