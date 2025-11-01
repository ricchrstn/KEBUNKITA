{{-- resources/views/layouts/guest-layout.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Para Petani') }}</title>

    {{-- Favicon dan App Icons --}}
    <link rel="icon" type="image/png" href="{{ asset('./img/Modern Logo with House and Leaf Emblem.png') }}">
    <meta name="theme-color" content="#059669">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-foreground antialiased">
    {{-- Menggunakan kelas tema: bg-background --}}
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-background">
        <div>
            <a href="/" class="flex flex-col items-center space-y-2">
                <img src="{{ asset('./img/Modern Logo with House and Leaf Emblem.png') }}" alt="KebunKita Logo" class="w-8 h-8">
                <span class="text-xl font-bold text-primary">KebunKita</span>
            </a>
        </div>

        {{-- Menggunakan kelas tema: bg-card --}}
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-card shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
