<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            NewsSeeder::class,
            CollectionSeeder::class,
            SiteSettingSeeder::class,
            FooterLinkSeeder::class,
            FaqSeeder::class,
        ]);

        Agenda::factory()->count(6)->create();
    }
}