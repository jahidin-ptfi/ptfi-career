<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'en') }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() ?? '' }}">

    <title>{{ $title ?? 'Authentication' }} — {{ config('app.name', 'Enterprise SaaS') }}</title>

    <!-- Theme Initialization Script -->
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
<body class="min-h-full flex flex-col justify-center bg-zinc-50 font-sans text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">
    <!-- Top Right Theme Switcher -->
    <div class="fixed top-4 right-4 z-50">
        <x-ui.theme-toggle />
    </div>

    <!-- Auth Content Container -->
    <div class="w-full flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        {{ $slot ?? '' }}
        @yield('content')
    </div>

    <!-- Global Toast Notifications -->
    <x-ui.toast />
</body>
</html>
