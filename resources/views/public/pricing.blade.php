@extends('layouts.public', ['title' => 'Paket Harga — FluxBlade UI'])

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <!-- Header -->
    <div class="text-center max-w-2xl mx-auto mb-16">
        <x-ui.badge variant="primary">Paket Transparan</x-ui.badge>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
            Pilihan paket sesuai skala bisnis Anda
        </h1>
        <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-400">
            Mulai gratis untuk prototipe, tingkatkan ke enterprise saat aplikasi Anda siap melayani jutaan pengguna.
        </p>
    </div>

    <!-- Pricing Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
        <!-- Starter Plan -->
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 sm:p-8 dark:border-zinc-800 dark:bg-zinc-900 flex flex-col justify-between shadow-2xs">
            <div>
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Starter</h3>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Untuk developer individu & proyek hobi.</p>
                <div class="mt-6 flex items-baseline gap-1">
                    <span class="text-3xl font-extrabold text-zinc-900 dark:text-zinc-100">Gratis</span>
                    <span class="text-xs text-zinc-400">/ selamanya</span>
                </div>
                <ul class="mt-6 space-y-3 text-xs text-zinc-600 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800 pt-6">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Akses 15 komponen Blade dasar</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Tailwind CSS & Alpine.js support</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Dark & Light mode switcher</span>
                    </li>
                </ul>
            </div>
            <div class="mt-8">
                <x-ui.button variant="secondary" class="w-full justify-center">Mulai Gratis</x-ui.button>
            </div>
        </div>

        <!-- Pro Plan (Featured) -->
        <div class="relative rounded-2xl border-2 border-blue-600 bg-white p-6 sm:p-8 dark:border-blue-500 dark:bg-zinc-900 flex flex-col justify-between shadow-xl ring-4 ring-blue-500/10">
            <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                <x-ui.badge variant="primary" class="font-semibold shadow-xs">Paling Populer</x-ui.badge>
            </div>
            <div>
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Professional</h3>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Untuk startup & aplikasi SaaS komersial.</p>
                <div class="mt-6 flex items-baseline gap-1">
                    <span class="text-3xl font-extrabold text-zinc-900 dark:text-zinc-100">Rp 299.000</span>
                    <span class="text-xs text-zinc-400">/ bulan</span>
                </div>
                <ul class="mt-6 space-y-3 text-xs text-zinc-600 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800 pt-6">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span class="font-medium text-zinc-900 dark:text-zinc-200">Seluruh 25+ komponen Blade</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Template Admin Dashboard lengkap</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Data Table dengan filter & sort</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Dukungan email prioritas</span>
                    </li>
                </ul>
            </div>
            <div class="mt-8">
                <x-ui.button variant="primary" class="w-full justify-center shadow-md">Pilih Paket Pro</x-ui.button>
            </div>
        </div>

        <!-- Enterprise Plan -->
        <div class="rounded-2xl border border-zinc-200/80 bg-white p-6 sm:p-8 dark:border-zinc-800 dark:bg-zinc-900 flex flex-col justify-between shadow-2xs">
            <div>
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Enterprise</h3>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Untuk perusahaan skala besar & agensi software.</p>
                <div class="mt-6 flex items-baseline gap-1">
                    <span class="text-3xl font-extrabold text-zinc-900 dark:text-zinc-100">Rp 1.499.000</span>
                    <span class="text-xs text-zinc-400">/ bulan</span>
                </div>
                <ul class="mt-6 space-y-3 text-xs text-zinc-600 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800 pt-6">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Lisensi unlimited developer</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Custom theme tokens setup</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Dedicated Slack & WhatsApp support</span>
                    </li>
                </ul>
            </div>
            <div class="mt-8">
                <x-ui.button variant="secondary" class="w-full justify-center">Hubungi Sales</x-ui.button>
            </div>
        </div>
    </div>
</div>
@endsection
