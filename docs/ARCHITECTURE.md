# ARCHITECTURE.md

> Mencerminkan struktur project SEJAUH YANG TERKONFIRMASI di percakapan. Beberapa detail (isi file persis, keberadaan file tertentu) tidak pernah diverifikasi langsung oleh AI (AI tidak punya akses filesystem user) — ditandai TODO/UNKNOWN. **Source code adalah sumber kebenaran utama; audit file sebelum coding.**

## Versi & Tooling
- Laravel 12.x (`LARAVEL 12.64.0` terlihat di error page terakhir)
- PHP 8.5.6 (lokal dev)
- Vite 7.x, Tailwind CSS v4 (plugin `@tailwindcss/vite`, bukan `tailwindcss` CLI/PostCSS klasik)
- Alpine.js (core + `@alpinejs/focus`)
- MySQL (Laragon)

## Struktur Folder Penting

```
app/
  Http/
    Controllers/
      Public/        # HomeController, AboutController, NewsController, CollectionController,
                      # ContactController, FaqController, AgendaController, ChatController,
                      # FeedbackController, SitemapController
      Admin/          # AuthController, DashboardController, NewsController, CollectionController,
                      # AgendaController, FeedbackController
                      # (ReservationController & ServiceRequestController ADMIN sudah DIHAPUS)
      LocaleController.php   # switch bahasa ID/EN
    Middleware/
      SetLocale.php   # baca session('locale'), App::setLocale()
    Requests/          # StoreNewsRequest, UpdateNewsRequest, StoreCollectionRequest,
                       # UpdateCollectionRequest, StoreAgendaRequest, StoreChatMessageRequest,
                       # StoreFeedbackRequest, dll.
  Models/
    News, NewsCategory, Collection, CollectionCategory, ExternalServiceLink,
    Agenda, Faq, SiteSetting, FooterLink, User (+HasRoles),
    ChatSession, ChatMessage, Feedback
    Reservation, ServiceRequest, ServiceRequestType  # MODEL & TABEL MASIH ADA tapi TIDAK DIPAKAI
                                                       # publik (form dihapus, admin dihapus) — dead code
  Services/
    Chatbot/
      ChatProviderInterface.php
      ChatProviderFactory.php
      OpenAiCompatibleProvider.php   # dipakai untuk openai/openrouter/lmstudio
      OllamaProvider.php
      GeminiProvider.php
      ClaudeProvider.php
    AutoTranslator.php   # fallback auto-translate via MyMemory API, cache ke lang/en.json
  Providers/
    AppServiceProvider.php   # View::composer('components.footer', ...), Paginator::defaultView(...)
  helpers.php            # fungsi global t() — autoload via composer.json "files"

resources/
  views/
    components/
      layout.blade.php          # layout publik utama, props: title, description, image, solidNav
      navbar.blade.php           # prop `solid` (default true), dipanggil <x-navbar :solid="$solidNav"/>
      footer.blade.php
      hero.blade.php              # dipakai di Home
      quick-access.blade.php
      profile-section.blade.php
      services-grid.blade.php
      agenda-section.blade.php    # section Agenda di Homepage (scroll-activated calendar+featured)
      news-card.blade.php
      book-card.blade.php
      faq-accordion.blade.php
      home-sidebar.blade.php
      visit-section.blade.php
      external-service-card.blade.php
      social-icon.blade.php       # ikon SVG brand platform sosial (custom, bukan logo asli berlisensi)
      social-qr.blade.php
      feedback-widget.blade.php
      chatbot-widget.blade.php
      accessibility-widget.blade.php
      layouts/
        admin.blade.php           # layout admin, sidebar fixed (lg:sticky lg:top-0 lg:h-screen)
    pages/
      home.blade.php
      about.blade.php             # HALAMAN PALING SERING DIREDESIGN — cek isi terbaru sebelum ubah
      faq.blade.php
      contact.blade.php
      news/index.blade.php, news/show.blade.php
      collections/index.blade.php, collections/show.blade.php
      services/  # SUDAH DIHAPUS (route /layanan dihapus)
      service-requests/create.blade.php  # ORPHAN, route sudah dihapus, mungkin masih ada filenya
    admin/
      dashboard.blade.php
      news/ (index, create, edit)
      collections/ (index, create, edit)
      agendas/ (index, create, edit)
      feedback/index.blade.php
      auth/login.blade.php
    vendor/
      pagination/bb-pustaka.blade.php   # custom pagination view, diregister di AppServiceProvider
  css/
    app.css              # entry Tailwind v4, @theme token warna/font, @import "./accessibility.css"
    accessibility.css     # rules untuk semua class a11y-* (PERNAH KOSONG/CORRUPT — selalu cek isi kalau fitur a11y "tidak berfungsi")
  js/
    app.js                # entry: import bootstrap, Alpine, plugin focus, registerAccessibilityStore,
                          # registerChatStore, pageshow bfcache-reload guard
    accessibility.js       # Alpine.store('a11y', ...)
    chat.js                 # Alpine.store('chat', ...), marked+DOMPurify+highlight.js

routes/
  web.php     # semua route publik + require admin.php
  admin.php   # semua route /admin/*

database/
  migrations/  # urut kronologis, lihat bagian "Migration Penting" di bawah
  seeders/     # RoleSeeder, NewsSeeder, CollectionSeeder (termasuk ExternalServiceLink 7 item),
              # SiteSettingSeeder, FooterLinkSeeder, FaqSeeder
              # ServiceRequestTypeSeeder — TIDAK dipanggil lagi di DatabaseSeeder (fitur dihapus)

config/
  chatbot.php   # provider aktif + kredensial per provider, baca dari .env

lang/
  en.json    # ~150+ entri terjemahan manual, key = teks Indonesia persis

public/
  images/
    logo-bbpustaka.png          # CONFIRMED ada
    gedung-bb-pustaka.jpeg       # CONFIRMED ada (foto asli gedung, diupload user)
    gedung01-bb-pustaka.jpeg     # TODO/UNKNOWN — direferensikan di about.blade.php terakhir,
                                 # keberadaan file INI TIDAK PERNAH DIKONFIRMASI ke AI
    bb-pustaka.jpeg               # TODO/UNKNOWN — sama seperti di atas
```

## Routing Ringkas (routes/web.php)

| Route | Method | Controller | Catatan |
|---|---|---|---|
| `/` | GET | HomeController@index | Home |
| `/tentang-kami` | GET | AboutController@index | About, sering diredesign |
| `/koleksi`, `/koleksi/{slug}` | GET | CollectionController | search via `?q=` |
| `/berita`, `/berita/{slug}` | GET | NewsController | search via `?q=` (fixed setelah bug view tertukar) |
| `/faq` | GET | FaqController | |
| `/kontak` | GET/POST | ContactController | |
| `/sitemap.xml` | GET | SitemapController | |
| `/bahasa/{locale}` | GET | LocaleController@switch | id/en, redirect back() |
| `/agenda/by-date` | GET | AgendaController@byDate | JSON, dipakai Alpine di agenda-section |
| `/chat/sessions` dst. | POST/GET | ChatController | |
| `/feedback` | POST | FeedbackController@store | JSON |
| `/admin/*` | — | lihat routes/admin.php | auth + role:admin |

**Route yang SUDAH DIHAPUS**: `/layanan` (+ show), `/agenda` (halaman publik terpisah — diganti section di Home), `/reservasi`, `/pengajuan-layanan/*`.

## Migration Penting (kronologis, ringkas)
1. Skema dasar Laravel + `permission_tables` (Spatie)
2. `news_categories`, `news`
3. `agendas` (title, description, location, starts_at, ends_at)
4. `collection_categories`, `collections` (awalnya termasuk `stock`)
5. `external_service_links`
6. `reservations`, `service_request_types`, `service_requests` (SEKARANG TIDAK DIPAKAI publik/admin)
7. `site_settings`, `footer_links`
8. `faqs`
9. `chat_sessions`, `chat_messages`
10. `feedbacks`
11. **`collections`**: tambah `page_count`, `access_link`; **DROP `stock`** (BB Pustaka = perpustakaan referensi, tidak ada peminjaman bawa pulang)
12. **`agendas`**: tambah `category`, `image_path`

## Middleware Global (bootstrap/app.php)
- Alias: `role`, `permission` (Spatie)
- `redirectGuestsTo(fn () => route('admin.login'))`
- `web` middleware group: append `SetLocale::class`

## Catatan Arsitektur Khusus
- **Admin sidebar layout**: pakai `lg:sticky lg:top-0 lg:h-screen lg:self-start` (BUKAN `lg:static`) — versi lama `lg:static` menyebabkan tombol Keluar hilang dari viewport karena sidebar ikut memanjang mengikuti tinggi konten.
- **Pagination**: default view Laravel diganti global lewat `Paginator::defaultView('vendor.pagination.bb-pustaka')` di `AppServiceProvider::boot()`.
- **Footer data**: disuntik lewat View Composer (`View::composer('components.footer', ...)`), bukan dikirim manual dari tiap controller.
- **Cache**: `SiteSetting::get()` dan `ExternalServiceLink::cachedActiveLinks()` di-cache 1 jam (`Cache::remember`) — kalau update data settings/quick-access lewat Tinker/seeder dan tidak muncul, jalankan `php artisan cache:clear`.
