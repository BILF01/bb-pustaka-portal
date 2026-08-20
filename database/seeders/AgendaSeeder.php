<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $items=[
            [
                'title'=>'Mahasiswa Polbangtan YoMa Belajar Akses Sumber Informasi Pertanian',
                'description'=>'BB Pustaka mengenalkan layanan perpustakaan, koleksi digital, jurnal ilmiah, dan praktik penelusuran sumber informasi pertanian kepada mahasiswa Polbangtan Yogyakarta–Magelang.',
                'location'=>'Polbangtan Yogyakarta–Magelang, Magelang',
                'category'=>'Literasi Pertanian',
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Februari/WhatsApp_Image_2026-02-13_at_143702.jpeg',
                'starts_at'=>'2026-02-13 00:00:00',
                'ends_at'=>null,
            ],
            [
                'title'=>'BB Pustaka Berpartisipasi dalam Book Fair 2026',
                'description'=>'BB Pustaka berpartisipasi dalam Book Fair 2026 untuk memperkenalkan koleksi serta memperkuat literasi pertanian melalui pameran, diskusi, dan kegiatan literasi.',
                'location'=>'IPB International Convention Center, Botani Square Bogor',
                'category'=>'Pameran & Literasi',
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/655149c6-4d9c-4831-a876-fe145154dfa8.jpg',
                'starts_at'=>'2026-03-25 00:00:00',
                'ends_at'=>null,
            ],
            [
                'title'=>'Library Tour Dinas Arsip dan Perpustakaan Kota Bogor',
                'description'=>'Dinas Arsip dan Perpustakaan Kota Bogor mengikuti library tour untuk mengenal layanan perpustakaan, koleksi antikuariat, repository pertanian, dan proses digitalisasi koleksi BB Pustaka.',
                'location'=>'BB Pustaka, Bogor',
                'category'=>'Kepustakawanan',
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/April/WhatsApp_Image_2026-04-29_at_131204.jpeg',
                'starts_at'=>'2026-04-29 00:00:00',
                'ends_at'=>null,
            ],
            [
                'title'=>'Membangun Ketahanan Digital di Lingkup ASN',
                'description'=>'Kegiatan BB Pustaka untuk meningkatkan pemahaman pegawai mengenai keamanan siber, literasi digital, perlindungan data, serta pemanfaatan teknologi informasi secara bertanggung jawab.',
                'location'=>'Kantor BB Pustaka, Bogor',
                'category'=>'Literasi Digital',
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Mei/2a17cccc-2207-4fd7-9490-bdbe8789ef86.jpg',
                'starts_at'=>'2026-05-25 00:00:00',
                'ends_at'=>null,
            ],
            [
                'title'=>'Pelatihan Kemas Ulang Informasi bagi Penyuluh Pertanian',
                'description'=>'BB Pustaka memberikan pelatihan kepada Penyuluh Pertanian Lapangan untuk meningkatkan keterampilan menyaring, mengolah, dan menyajikan informasi pertanian agar lebih mudah dipahami masyarakat.',
                'location'=>'Perpustakaan Daerah Kabupaten Sukabumi',
                'category'=>'Pelatihan',
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/Mei/sukabumi.jpg',
                'starts_at'=>'2026-06-17 00:00:00',
                'ends_at'=>null,
            ],
            [
                'title'=>'Literasi Anak dan Apresiasi Pendidikan DWP BB Pustaka',
                'description'=>'Dharma Wanita Persatuan BB Pustaka menggelar kegiatan literasi anak sekaligus memberikan apresiasi pendidikan kepada anak pegawai berprestasi sebagai dukungan terhadap budaya membaca dan pendidikan.',
                'location'=>'BB Pustaka, Bogor',
                'category'=>'Literasi',
                'image_path'=>'https://pustaka.bppsdmp.pertanian.go.id/images/2026/dana_pendidikan.jpg',
                'starts_at'=>'2026-07-09 00:00:00',
                'ends_at'=>null,
            ],
        ];

        foreach($items as $item){
            $date=Carbon::parse($item['starts_at'])->toDateString();

            $agenda=Agenda::query()
                ->where('title',$item['title'])
                ->whereDate('starts_at',$date)
                ->first()??new Agenda();

            $agenda->title=$item['title'];
            $agenda->description=$item['description'];
            $agenda->location=$item['location'];
            $agenda->category=$item['category'];
            $agenda->image_path=$item['image_path'];
            $agenda->starts_at=$item['starts_at'];
            $agenda->ends_at=$item['ends_at'];
            $agenda->save();
        }
    }
}