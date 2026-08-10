<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin - BB Pustaka</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo-bbpustaka.png') }}">
<link rel="icon" type="image/png" href="{{ asset('images/logo-bbpustaka.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
@vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background min-h-screen flex items-center justify-center px-4">
<div class="w-full max-w-md bg-white p-8 rounded-xl shadow-lg border border-outline-variant/30">
<div class="text-center mb-8">
<img src="{{ asset('images/logo-bbpustaka.png') }}" alt="Logo BB Pustaka" class="w-12 h-12 mx-auto object-contain">
<h1 class="text-xl font-bold text-primary mt-2">Login Admin BB Pustaka</h1>
</div>
@if ($errors->any())
<div class="mb-4 p-4 rounded-lg bg-error-container text-on-error-container text-sm" role="alert">{{ $errors->first() }}</div>
@endif
<form method="POST" action="{{ route('admin.login.attempt') }}" class="space-y-4">
@csrf
<div>
<label for="email" class="text-sm font-semibold block mb-1">Email</label>
<input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
</div>
<div>
<label for="password" class="text-sm font-semibold block mb-1">Kata Sandi</label>
<input id="password" name="password" type="password" required class="w-full p-3 border border-outline-variant rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
</div>
<label class="flex items-center gap-2 text-sm">
<input type="checkbox" name="remember" class="w-4 h-4">
Ingat saya
</label>
<button type="submit" class="w-full h-12 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container transition-all">Masuk</button>
</form>
</div>
</body>
</html>