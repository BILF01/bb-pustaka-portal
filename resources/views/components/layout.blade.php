@props([
    'title' => null,
    'description' => 'Balai Besar Perpustakaan dan Literasi Pertanian - Pusat dokumentasi dan literasi ilmu pertanian nasional.',
    'image' => null,
])

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <title>{{ $title ? $title.' - BB Pustaka' : 'BB Pustaka - Balai Besar Perpustakaan dan Literasi Pertanian' }}</title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title ? $title.' - BB Pustaka' : 'BB Pustaka' }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="BB Pustaka">
    @if ($image)
        <meta property="og:image" content="{{ $image }}">
    @endif

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title ? $title.' - BB Pustaka' : 'BB Pustaka' }}">
    <meta name="twitter:description" content="{{ $description }}">
    @if ($image)
        <meta name="twitter:image" content="{{ $image }}">
    @endif

    <link rel="icon" type="image/png" href="{{ asset('images/logo-bbpustaka.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-surface overflow-x-hidden">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:z-[200] focus:top-2 focus:left-2 focus:bg-primary focus:text-on-primary focus:px-4 focus:py-2 focus:rounded-md">
        Lewati ke konten utama
    </a>

    <x-navbar />

    <main id="main-content">
        {{ $slot }}
    </main>

    <x-footer />

    <x-accessibility-widget />
    <x-chatbot-widget />
</body>
</html>