<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\ExternalServiceLink;
use App\Models\Faq;
use App\Models\News;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $slides = [
            ['image' => 'https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=1600&q=80'],
            ['image' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=1600&q=80'],
            ['image' => 'https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=1600&q=80'],
        ];

        $stats = [
            ['value' => '180+ Tahun', 'label' => 'Warisan Sejarah'],
            ['value' => '100k+ Koleksi', 'label' => 'Literasi Pertanian'],
            ['value' => 'Terintegrasi', 'label' => 'Digital Repository'],
            ['value' => '24/7', 'label' => 'Layanan Online'],
        ];

        $profile = [
            'image' => asset('images/gedung-bb-pustaka.jpeg'),
            'image_alt' => 'Gedung Balai Besar Perpustakaan dan Literasi Pertanian',
            'founded_year' => '1842',
            'founded_label' => 'Awal Berdirinya PUSTAKA',
            'heading' => 'Sejarah & Visi Pustaka Pertanian',
            'description' => 'BB Pustaka (Balai Besar Perpustakaan dan Literasi Pertanian) merupakan lembaga yang bertransformasi dari Bibliotheca Bogoriensis yang didirikan pada tahun 1817. Kami berkomitmen untuk menjadi pusat rujukan literasi pertanian terdepan di Indonesia.',
            'vision' => 'Menjadi pusat literasi pertanian global yang handal dan mandiri.',
            'mission' => 'Mengelola pengetahuan dan teknologi pertanian untuk kemaslahatan masyarakat.',
        ];

        $services = [
            ['icon' => 'search_insights', 'name' => 'Smart OPAC', 'description' => 'Pencarian katalog koleksi cetak secara cerdas'],
            ['icon' => 'cloud_sync', 'name' => 'Repository', 'description' => 'Simpanan digital karya ilmiah pertanian'],
            ['icon' => 'psychology', 'name' => 'AI Assistant', 'description' => 'Asisten cerdas untuk pencarian literatur'],
            ['icon' => 'live_help', 'name' => 'Reference Service', 'description' => 'Layanan rujukan informasi pertanian'],
            ['icon' => 'inventory_2', 'name' => 'Digital Archive', 'description' => 'Akses arsip sejarah pertanian nasional'],
            ['icon' => 'auto_stories', 'name' => 'E-Book Library', 'description' => 'Koleksi buku elektronik pertanian lengkap'],
            ['icon' => 'support_agent', 'name' => 'Ask Librarian', 'description' => 'Konsultasi langsung dengan pustakawan'],
            ['icon' => 'border_color', 'name' => 'Citation Assistance', 'description' => 'Bantuan standarisasi sitasi ilmiah'],
            ['icon' => 'construction', 'name' => 'Library Tools', 'description' => 'Peralatan pendukung riset dan pustaka'],
            ['icon' => 'meeting_room', 'name' => 'Meeting Room Booking', 'description' => 'Reservasi ruang diskusi dan rapat'],
            ['icon' => 'person_add', 'name' => 'Visitor Registration', 'description' => 'Pendaftaran kunjungan individu/kelompok'],
            ['icon' => 'recommend', 'name' => 'Collection Recommendation', 'description' => 'Usulan pengadaan koleksi baru'],
            ['icon' => 'publish', 'name' => 'Publication Center', 'description' => 'Pusat penerbitan jurnal dan buku'],
            ['icon' => 'database', 'name' => 'Knowledge Repository', 'description' => 'Pangkalan data pengetahuan terpadu'],
            ['icon' => 'help_center', 'name' => 'FAQ', 'description' => 'Jawaban atas pertanyaan umum'],
        ];

        $latestNews = News::with('category')
            ->published()
            ->latestFirst()
            ->take(2)
            ->get();

        $featuredCollections = Collection::featured()->take(4)->get();

        $quickLinks = ExternalServiceLink::cachedActiveLinks()->toArray();

        $faqs = Faq::ordered()->take(4)->get();

        $agendaList = \App\Models\Agenda::orderBy('starts_at')->get();
        $featuredAgenda = $agendaList->first(fn ($a) => $a->status() === 'Sedang Berlangsung')
            ?? $agendaList->first(fn ($a) => $a->status() === 'Akan Dimulai')
            ?? $agendaList->sortByDesc('starts_at')->first();
        $otherAgendas = $agendaList
            ->reject(fn ($a) => $featuredAgenda && $a->is($featuredAgenda))
            ->take(4);

        return view('pages.home', compact(
            'featuredAgenda',
            'otherAgendas',
            'slides',
            'stats',
            'quickLinks',
            'profile',
            'services',
            'latestNews',
            'featuredCollections',
            'faqs'
        ));
    }
}