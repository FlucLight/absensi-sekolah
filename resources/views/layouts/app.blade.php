<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-950 text-white overflow-x-hidden" x-data="{ openMobile: false }">

    @include('layouts.navigation')

    <div class="relative min-h-screen transition-all duration-300 md:ml-64">

        @if (isset($header))
        <header class="bg-gray-950/50 border-b border-white/5 backdrop-blur-xl sticky top-0 z-40 hidden md:block">
            <div class="max-w-7xl mx-auto py-4 px-6 text-xl font-bold">
                {{ $header }}
            </div>
        </header>
        @endif

        <main class="p-4 sm:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>
<style>
    /* Bikin scrollbar-nya jadi estetik biar nggak ngerusak Dark Mode */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.1);
    }
</style>
</body>

</html>