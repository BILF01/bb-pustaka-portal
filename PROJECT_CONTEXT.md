# BB PUSTAKA PORTAL — PROJECT CHECKPOINT

Tanggal checkpoint: 20 Agustus 2026

## ATURAN KERJA

- Gunakan `workflow-prompt.md` dari ChatGPT Library sebagai workflow utama.
- Source code aktual adalah sumber kebenaran utama.
- Sebelum memberi patch, audit file aktual dengan `Get-Content`, `Select-String`, atau command yang sesuai.
- Jangan menebak source dari riwayat percakapan.
- Untuk patch `Cari -> Ganti`, blok `Cari` harus copy persis dari source aktual dan unik.
- Jangan mengubah file atau section yang tidak diminta.

## STATUS HOMEPAGE

### Agenda
STATUS: FINAL / LOCKED

Section Agenda sudah selesai.
Jangan mengubah `resources/views/components/agenda-section.blade.php` atau logic Agenda kecuali diminta secara eksplisit.

### Footer
STATUS: REDESIGN / FINISHING

Arah desain footer saat checkpoint:
- Footer compact, bukan footer besar/tinggi.
- Background utama menggunakan warna hijau default project (`bg-primary`).
- Aksen transisi atas menggunakan garis, bukan blur/gradient.
- Identitas di kiri menggunakan nama lengkap:
  `Balai Besar Perpustakaan dan Literasi Pertanian`.
- Identitas visual mengikuti pola logo + nama instansi.
- Tautan Cepat, Informasi, Kontak, dan media sosial tetap dipertahankan.
- Jangan memperbesar spacing footer tanpa permintaan.

## KONDISI GIT SAAT CHECKPOINT

Branch: master

Working tree sebelum checkpoint memiliki banyak perubahan dari rangkaian pengembangan/redesign sebelumnya.

Tracked files yang terhapus dan harus dianggap sebagai keputusan yang perlu diaudit sebelum dibuat ulang:
- app/Http/Controllers/Public/FaqController.php
- resources/views/pages/faq.blade.php
- resources/views/components/services-grid.blade.php

Terdapat juga file baru untuk Hero Slide, Contact Message, Agenda Seeder, asset gambar, profile CSS, admin Hero Slide, admin Contact Message, dan reservation CTA.

Keberadaan file pada checkpoint bukan berarti seluruh fitur sudah dinyatakan final. Source aktual tetap harus diaudit sebelum perubahan berikutnya.

## CATATAN KEAMANAN

Checkpoint ini dibuat untuk menyediakan titik rollback setelah banyak perubahan project.

Jangan menggunakan `git restore`, `git reset --hard`, atau `git clean` tanpa memeriksa kondisi Git dan tujuan rollback terlebih dahulu.
