<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = NewsCategory::factory()->count(5)->create();

        $categories->each(function (NewsCategory $category): void {
            News::factory()->count(4)->create([
                'news_category_id' => $category->id,
            ]);
        });
    }
}