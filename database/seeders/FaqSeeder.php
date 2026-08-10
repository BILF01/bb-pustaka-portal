<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Bagaimana cara meminjam buku di BB Pustaka?',
                'answer' => 'Kunjungi Katalog Online untuk mencari koleksi, lalu datang langsung ke perpustakaan dengan membawa kartu anggota untuk proses peminjaman.',
                'sort_order' => 1,
            ],
            [
                'question' => 'Apakah layanan perpustakaan gratis?',
                'answer' => 'Ya, seluruh layanan BB Pustaka termasuk kunjungan, peminjaman, dan akses digital tidak dipungut biaya.',
                'sort_order' => 2,
            ],
            [
                'question' => 'Bagaimana cara mengakses Repository dan Smart OPAC?',
                'answer' => 'Kedua layanan tersebut dapat diakses langsung melalui tombol Quick Access di halaman Beranda.',
                'sort_order' => 3,
            ],
            [
                'question' => 'Apa jam operasional BB Pustaka?',
                'answer' => 'Senin - Kamis pukul 08.00 - 16.00 WIB, dan Jumat pukul 08.00 - 16.30 WIB.',
                'sort_order' => 4,
            ],
            [
                'question' => 'Bagaimana cara mengajukan reservasi kunjungan atau layanan lainnya?',
                'answer' => 'Pengajuan reservasi kunjungan, booking ruang rapat, dan layanan publik lainnya dikelola melalui sistem layanan terpadu BB Pustaka.',
                'sort_order' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(['question' => $faq['question']], $faq);
        }
    }
}