# BB PUSTAKA PORTAL — PROJECT CHECKPOINT

Tanggal checkpoint: 22 Agustus 2026

## ATURAN KERJA

- Gunakan `workflow-prompt.md` dari ChatGPT Library sebagai workflow utama.
- Source code aktual adalah sumber kebenaran utama.
- Sebelum memberi patch, audit source aktual menggunakan `Get-Content`, `Select-String`, atau command yang sesuai.
- Jangan menebak source berdasarkan riwayat percakapan.
- Jika beberapa file saling berkaitan, audit file-file tersebut bersama sebelum patch.
- Untuk patch `Cari -> Ganti`, blok `Cari` harus copy persis dari source aktual, pendek, dan unik.
- Perubahan struktural besar lebih aman menggunakan FULL FILE.
- Jangan mengubah section atau modul yang tidak diminta.
- Jangan menggunakan `git reset --hard`, `git clean`, atau tindakan destruktif tanpa audit dan persetujuan.
- Pertahankan kode compact dan konsisten dengan style project.

## STACK PROJECT

- Laravel 12.x
- PHP 8.5.x
- MySQL
- Tailwind CSS v4
- Alpine.js
- Spatie Laravel Permission
- Laragon / Windows

## STATUS PUBLIC SITE

### Homepage
STATUS: REDESIGN LANJUT / STABIL

Homepage telah mengalami redesign dan audit responsive pada berbagai section.

Komponen yang telah disentuh antara lain:
- navbar
- quick access
- profile section
- visit section
- reservation CTA
- information sources
- home sidebar
- accessibility widget
- chatbot widget

Jangan melakukan redesign ulang tanpa audit source aktual.

### Koleksi
STATUS: FINAL / LOCKED

Halaman index dan detail Koleksi telah selesai.

Catatan:
- index menggunakan layout responsive.
- detail menggunakan botanical background.
- asset detail aktif: `public/images/collection-detail-bg.png`.

Jangan rework kecuali diminta secara eksplisit.

### Berita
STATUS: FINAL / LOCKED

Halaman index dan detail Berita telah selesai.

Detail berita menggunakan:
`public/images/background-show-berita-v2.png`

Asset lama:
`public/images/background-show-berita.png`
sudah tidak digunakan dan dihapus.

Jangan mengembalikan asset lama tanpa audit source.

### Agenda
STATUS: FINAL / LOCKED

Agenda public telah direfactor menjadi komponen:

`resources/views/components/agenda-section.blade.php`

dan:

`resources/views/components/agenda/`

Struktur komponen mencakup bagian featured, calendar, past, upcoming, dan modal.

File helper refactor serta backup `.bak` sudah dihapus setelah tidak diperlukan.

## ADMIN — ROLE DAN PERMISSION

Role aktif:

- `super_admin`
- `admin`
- `publikasi`
- `pustakawan`
- `kegiatan`
- `layanan`

### Super Admin

Memiliki seluruh permission, termasuk:

- `users.manage`
- `admins.manage`
- `activity-log.view`

Default account:

`superadmin@bbpustaka.go.id`

### Administrator

Memiliki akses operasional dan:

- `users.manage`

Tidak memiliki:

- `admins.manage`
- `activity-log.view`

Default account:

`admin@bbpustaka.go.id`

### Petugas Publikasi

Akses:
- Dashboard
- Berita
- Hero Slider

### Pustakawan

Akses:
- Dashboard
- Koleksi

### Petugas Kegiatan

Akses:
- Dashboard
- Agenda

### Petugas Layanan Informasi

Akses:
- Dashboard
- Umpan Balik
- Pesan Masuk

## KELOLA PETUGAS

STATUS: IMPLEMENTED

Fitur yang tersedia:

- daftar akun
- pencarian
- filter role
- filter status
- tambah akun
- edit nama
- edit email
- edit role/jobdesk
- status aktif/nonaktif
- reset password

Hierarchy:

### Super Admin
Dapat mengelola:
- Administrator
- seluruh petugas operasional

Tidak mengelola dirinya melalui Kelola Petugas.

### Admin
Hanya dapat mengelola:
- publikasi
- pustakawan
- kegiatan
- layanan

Admin tidak dapat melihat atau mengelola:
- Super Admin
- Administrator lain
- dirinya sendiri melalui Kelola Petugas

Super Admin tambahan belum dibuat melalui form umum Kelola Petugas.

## STATUS AKUN

Kolom `users.is_active` telah ditambahkan.

Akun nonaktif:
- tidak dapat login
- sesi aktif dibatalkan melalui mekanisme `EnsureActiveUser`

Middleware:
`app/Http/Middleware/EnsureActiveUser.php`

## PROFIL SAYA

STATUS: IMPLEMENTED

Semua user panel memiliki Profil Saya.

User dapat:
- mengubah nama
- mengubah email
- mengganti password sendiri dengan verifikasi password saat ini

User tidak dapat melalui Profil Saya:
- mengubah role sendiri
- mengubah status sendiri

Akses Profil Saya dipindahkan dari sidebar ke dropdown akun pada navbar admin.

Dropdown navbar berisi:
- Profil Saya
- Keluar

## ACTIVITY LOG

STATUS: IMPLEMENTED

Activity Log tersedia hanya untuk Super Admin melalui permission:

`activity-log.view`

Admin dan petugas tidak dapat melihat Activity Log.

Namun aktivitas Admin dan petugas tetap dapat dicatat.

Implementasi utama:

- `app/Models/ActivityLog.php`
- `app/Services/ActivityLogger.php`
- `app/Http/Controllers/Admin/ActivityLogController.php`
- `resources/views/admin/activity-logs/`
- migration `create_activity_logs_table`

Aktivitas akun yang dicatat meliputi:

- akun dibuat
- data akun diubah
- role diubah
- status akun diubah
- password akun direset
- profil sendiri diubah
- password sendiri diubah

Password lama maupun password baru tidak pernah disimpan ke Activity Log.

Sidebar Super Admin memiliki grouping:

ADMINISTRASI
- Kelola Petugas
- Activity Log

Sidebar Admin:

ADMINISTRASI
- Kelola Petugas

Petugas operasional tidak melihat grouping Administrasi.

## DASHBOARD ADMIN

Dashboard menyesuaikan data berdasarkan permission masing-masing role.

Jangan mengembalikan dashboard menjadi satu dashboard statis untuk semua role.

## CATATAN DESAIN ADMIN

Global redesign panel admin belum dilakukan.

Struktur dan fungsi role/account management diprioritaskan terlebih dahulu.

Arah berikutnya setelah checkpoint:
- audit global panel admin
- konsistensi sidebar
- navbar
- card
- tabel
- form
- spacing
- responsive/mobile
- accessibility

Jangan redesign masing-masing role secara terpisah. Gunakan satu admin shell yang konsisten dan permission menentukan modul yang terlihat.

## FILE DEVELOPMENT SEMENTARA YANG SUDAH DIHAPUS

File berikut sudah dipastikan tidak diperlukan dan tidak boleh dibuat ulang tanpa alasan:

- `apply-agenda-refactor.ps1`
- `resources/js/accessibility.js.bak`
- `resources/views/components/accessibility-widget.blade.php.bak`
- `resources/views/components/agenda-section.blade.php.bak-refactor-20260821-195434`
- `database/seeders/AgendaDummySeeder.php`

## KONDISI CHECKPOINT

Branch utama:
`master`

Checkpoint ini dibuat setelah rangkaian besar perubahan public site serta implementasi role hierarchy, Kelola Petugas, status akun, Profil Saya, dan Activity Log.

Source aktual tetap merupakan sumber kebenaran utama ketika pekerjaan dilanjutkan.
