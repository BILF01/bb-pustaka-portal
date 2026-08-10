<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('now', '+2 months');

        return [
            'title' => fake()->sentence(5),
            'description' => fake()->paragraph(),
            'location' => 'BB Pustaka, Bogor',
            'starts_at' => $start,
            'ends_at' => (clone $start)->modify('+3 hours'),
        ];
    }
}