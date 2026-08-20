<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Faq;
use App\Models\News;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroSlides = \App\Models\HeroSlide::ordered()->get();

        $slides = $heroSlides->isNotEmpty()
            ? $heroSlides->map(fn ($slide) => ['image' => $slide->image_path])->toArray()
            : [
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
            'badge_label' => 'Tentang Pustaka',
            'overlay_title' => 'Pusat Literasi Pertanian',
            'overlay_description' => 'Mengelola pengetahuan, koleksi, dan informasi pertanian untuk mendukung kebutuhan masyarakat.',
            'founded_footer_label' => 'Sejak',
            'features' => [
                ['icon' => 'menu_book', 'title' => 'Pengembangan Koleksi', 'description' => 'Mengembangkan sumber informasi pertanian yang relevan.'],
                ['icon' => 'support_agent', 'title' => 'Layanan Referensi', 'description' => 'Mendukung penelusuran dan kebutuhan informasi pertanian.'],
                ['icon' => 'publish', 'title' => 'Publikasi Pertanian', 'description' => 'Menyebarluaskan informasi dan pengetahuan pertanian.'],
                ['icon' => 'school', 'title' => 'Pembinaan Kepustakawanan', 'description' => 'Mendukung pengembangan layanan dan kompetensi perpustakaan.'],
            ],
        ];

        $latestNews = News::with('category')
            ->published()
            ->latestFirst()
            ->take(2)
            ->get();

        $featuredCollections = Collection::featured()->take(4)->get();

        $quickLinks = [
    [
        'label' => 'Koleksi',
        'description' => 'Jelajahi koleksi dan sumber informasi pertanian.',
        'icon' => 'menu_book',
        'url' => route('collections.index'),
    ],
    [
        'label' => 'Berita & Artikel',
        'description' => 'Informasi dan publikasi terbaru BB Pustaka.',
        'icon' => 'newspaper',
        'url' => route('news.index'),
    ],
    [
        'label' => 'Repository',
        'description' => 'Akses karya ilmiah dan publikasi pertanian.',
        'icon' => 'database',
        'url' => 'http://repository.pertanian.go.id',
        'external' => true,
    ],
    [
        'label' => 'AI Assistant',
        'description' => 'Tanyakan informasi portal dengan lebih cepat.',
        'icon' => 'smart_toy',
        'action' => 'open-chat',
        'featured' => true,
    ],
    [
        'label' => 'Kegiatan',
        'description' => 'Lihat jadwal dan kegiatan terbaru BB Pustaka.',
        'icon' => 'event_available',
        'url' => route('home').'#kegiatan',
    ],
    [
        'label' => 'Kontak & Lokasi',
        'description' => 'Hubungi kami dan temukan lokasi BB Pustaka.',
        'icon' => 'location_on',
        'url' => route('contact.index'),
    ],
    [
        'label' => 'Tentang Kami',
        'description' => 'Kenali profil, sejarah, dan peran BB Pustaka.',
        'icon' => 'account_balance',
        'url' => route('about'),
    ],
];

        $faqs = Faq::ordered()->take(4)->get();

        $agendaList=\App\Models\Agenda::orderBy('starts_at')->get();

        $featuredAgenda=$agendaList->first(fn($a)=>$a->status()==='Sedang Berlangsung')
            ??$agendaList->first(fn($a)=>$a->status()==='Akan Dimulai')
            ??$agendaList->sortByDesc('starts_at')->first();

        $upcomingAgendas=$agendaList
            ->filter(fn($a)=>$a->starts_at->isFuture())
            ->reject(fn($a)=>$featuredAgenda&&$a->is($featuredAgenda))
            ->take(6);

        $pastAgendas=$agendaList
            ->filter(fn($a)=>($a->ends_at??$a->starts_at)->isPast())
            ->reject(fn($a)=>$featuredAgenda&&$a->is($featuredAgenda))
            ->sortByDesc('starts_at')
            ->take(4);

        return view('pages.home', compact(
            'featuredAgenda',
            'upcomingAgendas',
            'pastAgendas',
            'slides',
            'stats',
            'quickLinks',
            'profile',
            'latestNews',
            'featuredCollections',
            'faqs'
        ));
    }
}