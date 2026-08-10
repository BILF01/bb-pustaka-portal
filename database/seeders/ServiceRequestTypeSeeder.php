<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\ServiceRequestType;
use Illuminate\Database\Seeder;

class ServiceRequestTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Pengajuan Buku Baru', 'slug' => 'pengajuan-buku-baru', 'icon' => 'library_add', 'sort_order' => 1],
            ['name' => 'Usulan Koleksi', 'slug' => 'usulan-koleksi', 'icon' => 'bookmarks', 'sort_order' => 2],
            ['name' => 'Permintaan Referensi', 'slug' => 'permintaan-referensi', 'icon' => 'description', 'sort_order' => 3],
            ['name' => 'Permintaan Digitalisasi', 'slug' => 'permintaan-digitalisasi', 'icon' => 'scanner', 'sort_order' => 4],
            ['name' => 'Permintaan Informasi', 'slug' => 'permintaan-informasi', 'icon' => 'info', 'sort_order' => 5],
            ['name' => 'Permintaan Kunjungan', 'slug' => 'permintaan-kunjungan', 'icon' => 'group', 'sort_order' => 6],
        ];

        foreach ($types as $type) {
            ServiceRequestType::query()->updateOrCreate(['slug' => $type['slug']], $type);
        }
    }
}