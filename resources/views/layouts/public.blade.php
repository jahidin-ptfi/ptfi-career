<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'en') }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() ?? '' }}">

    <title>{{ $title ?? config('app.name', 'Enterprise SaaS') }}</title>

    <!-- Theme Initialization Script (Avoids Flash of Wrong Theme) -->
    <script>
        (function() {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark) || (stored === 'system' && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col bg-zinc-50 font-sans text-zinc-900 antialiased selection:bg-blue-500 selection:text-white dark:bg-zinc-950 dark:text-zinc-100">
    <!-- Navigation Bar -->
    <x-public.navbar />

    <!-- Main Content -->
    <main class="flex-1">
        {{ $slot ?? '' }}
        @yield('content')
    </main>

    <!-- Footer -->
    <x-public.footer />

    <!-- Global Toast Notifications -->
    <x-ui.toast />
</body>
</html>
