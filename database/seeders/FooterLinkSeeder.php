<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\FooterLink;
use Illuminate\Database\Seeder;

class FooterLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            // Tautan Cepat
            ['group' => 'quick_links', 'label' => 'Katalog Online', 'url' => route('collections.index'), 'sort_order' => 1],
            ['group' => 'quick_links', 'label' => 'E-Journal Pertanian', 'url' => '#', 'sort_order' => 2],
            ['group' => 'quick_links', 'label' => 'Arsip Statis', 'url' => '#', 'sort_order' => 3],
            ['group' => 'quick_links', 'label' => 'Pendaftaran Anggota', 'url' => '#', 'sort_order' => 4],

            // Informasi
            ['group' => 'information', 'label' => 'Profil Lembaga', 'url' => route('about'), 'sort_order' => 1],
            ['group' => 'information', 'label' => 'Struktur Organisasi', 'url' => route('about'), 'sort_order' => 2],
            ['group' => 'information', 'label' => 'Visi & Misi', 'url' => route('about'), 'sort_order' => 3],
            ['group' => 'information', 'label' => 'Kontak Kami', 'url' => route('contact.index'), 'sort_order' => 4],

            // Sosial Media
            ['group' => 'social', 'label' => 'Facebook', 'url' => 'https://www.facebook.com/pustakakementan/?locale=id_ID', 'icon' => 'facebook', 'sort_order' => 1],
            ['group' => 'social', 'label' => 'Instagram', 'url' => 'https://www.instagram.com/pustaka.kementan/', 'icon' => 'instagram', 'sort_order' => 2],
            ['group' => 'social', 'label' => 'YouTube', 'url' => 'https://www.youtube.com/@PustakaKementerianPertanian/featured', 'icon' => 'youtube', 'sort_order' => 3],
        ];

        foreach ($links as $link) {
            FooterLink::query()->updateOrCreate(
                ['group' => $link['group'], 'label' => $link['label']],
                $link
            );
        }
    }
}