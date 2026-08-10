<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'BB Pustaka',
            'site_tagline' => 'Balai Besar Perpustakaan dan Literasi Pertanian',
            'org_name' => 'Sekretariat Jenderal Kementerian Pertanian RI',
            'address' => 'Jl. Ir. H. Juanda No.20, Kota Bogor, Jawa Barat 16122',
            'operational_hours' => "Senin - Kamis: 08.00 - 16.00 WIB\nJumat: 08.00 - 16.30 WIB",
            'email' => 'info@pustaka.bppsdmp.pertanian.go.id',
            'phone' => '(0251) 8321746',
            'map_embed_url' => 'https://maps.google.com/maps?q=Jl.+Ir.+H.+Juanda+No.20+Bogor&output=embed',
            'copyright_text' => 'BB Pustaka - Kementerian Pertanian Republik Indonesia. Hak Cipta Dilindungi.',
            'external_system_url' => 'https://layanan.pustaka.bppsdmp.pertanian.go.id',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}