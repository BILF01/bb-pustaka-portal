<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\CollectionCategory;
use App\Models\ExternalServiceLink;
use Illuminate\Database\Seeder;

class CollectionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = CollectionCategory::factory()->count(6)->create();

        $categories->each(function (CollectionCategory $category): void {
            Collection::factory()->count(4)->create([
                'collection_category_id' => $category->id,
            ]);
        });

        Collection::query()->inRandomOrder()->take(4)->update(['is_featured' => true]);

        $links = [
            [
                'key' => 'opac',
                'name' => 'Smart OPAC',
                'icon' => 'qr_code_scanner',
                'description' => 'Pencarian katalog koleksi cetak secara cerdas',
                'integration_mode' => 'external',
                'external_url' => 'https://opac.pustaka.bppsdmp.pertanian.go.id',
                'sort_order' => 1,
            ],
            [
                'key' => 'repository',
                'name' => 'Repository',
                'icon' => 'folder_special',
                'description' => 'Simpanan digital karya ilmiah pertanian',
                'integration_mode' => 'external',
                'external_url' => 'https://repository.pustaka.bppsdmp.pertanian.go.id',
                'sort_order' => 2,
            ],
            [
                'key' => 'ebook',
                'name' => 'E-Book',
                'icon' => 'menu_book',
                'description' => 'Koleksi buku elektronik pertanian lengkap',
                'integration_mode' => 'native',
                'native_route' => 'collections.index',
                'sort_order' => 3,
            ],
            [
                'key' => 'membership',
                'name' => 'Keanggotaan',
                'icon' => 'badge',
                'description' => 'Pendaftaran anggota perpustakaan',
                'integration_mode' => 'native',
                'native_route' => 'contact.index',
                'sort_order' => 4,
            ],
            [
                'key' => 'visit_schedule',
                'name' => 'Jadwal Kunjungan',
                'icon' => 'calendar_month',
                'description' => 'Reservasi kunjungan ke BB Pustaka',
                'integration_mode' => 'native',
                'native_route' => 'home',
                'sort_order' => 5,
            ],
            [
                'key' => 'ai_assistant',
                'name' => 'AI Assistant',
                'icon' => 'smart_toy',
                'description' => 'Asisten cerdas untuk pencarian literatur',
                'integration_mode' => 'external',
                'external_url' => '#',
                'sort_order' => 6,
            ],
            [
                'key' => 'library_tools',
                'name' => 'Library Tools',
                'icon' => 'build',
                'description' => 'Peralatan pendukung riset dan pustaka',
                'integration_mode' => 'native',
                'native_route' => 'services.index',
                'sort_order' => 7,
            ],
        ];

        foreach ($links as $link) {
            ExternalServiceLink::query()->updateOrCreate(['key' => $link['key']], $link);
        }
    }
}