<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'full_name' => fake()->name(),
            'institution' => fake()->company(),
            'purpose' => fake()->randomElement(['studi_pustaka', 'wisata_edukasi', 'penelitian', 'booking_ruang_rapat']),
            'visit_date' => fake()->dateTimeBetween('+1 day', '+1 month'),
            'person_count' => fake()->numberBetween(1, 20),
            'status' => 'pending',
        ];
    }
}