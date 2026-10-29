@extends('layouts.admin', ['title' => 'Galeri UI Components — Flux Blade System'])

@section('content')
<div class="max-w-5xl space-y-8" x-data="{
    tab: 'buttons',
    accordionOpen: 1
}">
    <x-admin.page-header 
        title="UI Components Gallery" 
        description="Katalog visual seluruh reusable Blade component: Button variants, Badges, Avatars, Toast notification triggers, Tabs, dan Accordions."
        :breadcrumbs="['Contoh UI' => null, 'Komponen' => null]"
    />

    <!-- Button System -->
    <x-ui.card title="Button System" description="7 varian tombol dengan 3 ukuran konsisten, state hover, focus, dan loading">
        <div class="space-y-4">
            <div>
                <h4 class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2">Varian Tombol</h4>
                <div class="flex flex-wrap gap-2.5 items-center">
                    <x-ui.button variant="primary">Primary</x-ui.button>
                    <x-ui.button variant="secondary">Secondary</x-ui.button>
                    <x-ui.button variant="outline">Outline</x-ui.button>
                    <x-ui.button variant="ghost">Ghost</x-ui.button>
                    <x-ui.button variant="danger">Danger</x-ui.button>
                    <x-ui.button variant="success">Success</x-ui.button>
                    <x-ui.button variant="link">Link Button</x-ui.button>
                </div>
            </div>

            <div class="pt-2 border-t border-zinc-100 dark:border-zinc-800">
                <h4 class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2">Ukuran (Sizes) & Loading State</h4>
                <div class="flex flex-wrap gap-3 items-center">
                    <x-ui.button size="sm">Small (sm)</x-ui.button>
                    <x-ui.button size="md">Medium (md)</x-ui.button>
                    <x-ui.button size="lg">Large (lg)</x-ui.button>
                    <x-ui.button loading="true" size="sm">Loading...</x-ui.button>
                    <x-ui.button disabled="true" size="sm">Disabled</x-ui.button>
                </div>
            </div>
        </div>
    </x-ui.card>

    <!-- Badges & Avatars -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Badges -->
        <x-ui.card title="Status Badges" description="Indikator status visual dengan aksen warna terukur">
            <div class="space-y-3">
                <div class="flex flex-wrap gap-2">
                    <x-ui.badge variant="neutral">Neutral</x-ui.badge>
                    <x-ui.badge variant="primary">Primary</x-ui.badge>
                    <x-ui.badge variant="success">Success</x-ui.badge>
                    <x-ui.badge variant="warning">Warning</x-ui.badge>
                    <x-ui.badge variant="danger">Danger</x-ui.badge>
                    <x-ui.badge variant="purple">Purple</x-ui.badge>
                </div>
                <div class="flex flex-wrap gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                    <x-ui.badge variant="neutral" dot="true">Draft</x-ui.badge>
                    <x-ui.badge variant="success" dot="true">Terverifikasi</x-ui.badge>
                    <x-ui.badge variant="warning" dot="true">Menunggu Review</x-ui.badge>
                    <x-ui.badge variant="danger" dot="true">Ditolak</x-ui.badge>
                </div>
            </div>
        </x-ui.card>

        <!-- Avatars -->
        <x-ui.card title="User Avatars" description="Foto profil atau inisial nama dengan indikator status kehadiran">
            <div class="space-y-4">
                <div class="flex items-center gap-4">
                    <x-ui.avatar initials="XS" size="xs" />
                    <x-ui.avatar initials="SM" size="sm" />
                    <x-ui.avatar initials="MD" size="md" status="online" />
                    <x-ui.avatar initials="LG" size="lg" status="busy" />
                    <x-ui.avatar initials="XL" size="xl" status="offline" />
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Toast Notifications Trigger -->
    <x-ui.card title="Toast Notifications" description="Notifikasi pop-up Alpine.js otomatis dan responsif">
        <div class="flex flex-wrap gap-3">
            <x-ui.button variant="secondary" size="sm" @click="$store.toasts.add({ title: 'Operasi Sukses', message: 'Data pengguna telah berhasil disimpan ke database.', type: 'success' })">
                <span class="text-emerald-600 font-semibold mr-1">✓</span> Trigger Success Toast
            </x-ui.button>

            <x-ui.button variant="secondary" size="sm" @click="$store.toasts.add({ title: 'Terjadi Kesalahan', message: 'Gagal terhubung dengan server API eksternal.', type: 'error' })">
                <span class="text-red-600 font-semibold mr-1">✕</span> Trigger Error Toast
            </x-ui.button>

            <x-ui.button variant="secondary" size="sm" @click="$store.toasts.add({ title: 'Peringatan Kuota', message: 'Kapasitas penyimpanan server telah mencapai 85%.', type: 'warning' })">
                <span class="text-amber-500 font-semibold mr-1">⚠</span> Trigger Warning Toast
            </x-ui.button>

            <x-ui.button variant="secondary" size="sm" @click="$store.toasts.add({ title: 'Informasi Sistem', message: 'Pembaruan terjadwal malam ini pukul 02:00 WIB.', type: 'info' })">
                <span class="text-blue-500 font-semibold mr-1">ℹ</span> Trigger Info Toast
            </x-ui.button>
        </div>
    </x-ui.card>

    <!-- Tabs & Accordions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Interactive Tabs -->
        <x-ui.card title="Tab Bar Component" description="Navigasi berpindah tab dengan keyboard focus & state aktif">
            <div>
                <div class="flex border-b border-zinc-200 dark:border-zinc-800 space-x-4 text-xs font-medium">
                    <button 
                        @click="tab = 'buttons'" 
                        :class="tab === 'buttons' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-zinc-500 hover:text-zinc-700'"
                        class="pb-2 cursor-pointer transition-colors"
                    >
                        Ikhtisar
                    </button>
                    <button 
                        @click="tab = 'specs'" 
                        :class="tab === 'specs' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-zinc-500 hover:text-zinc-700'"
                        class="pb-2 cursor-pointer transition-colors"
                    >
                        Spesifikasi
                    </button>
                    <button 
                        @click="tab = 'logs'" 
                        :class="tab === 'logs' ? 'border-b-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold' : 'text-zinc-500 hover:text-zinc-700'"
                        class="pb-2 cursor-pointer transition-colors"
                    >
                        Riwayat
                    </button>
                </div>

                <div class="py-4 text-xs text-zinc-600 dark:text-zinc-400">
                    <div x-show="tab === 'buttons'">
                        Tab Ikhtisar aktif: Menampilkan data umum aplikasi dan ringkasan metrik.
                    </div>
                    <div x-show="tab === 'specs'" style="display: none;">
                        Tab Spesifikasi aktif: Konfigurasi server PHP 8.3, Laravel 13, Tailwind v4.
                    </div>
                    <div x-show="tab === 'logs'" style="display: none;">
                        Tab Riwayat aktif: Audit trail dan log aktivitas pengembang.
                    </div>
                </div>
            </div>
        </x-ui.card>

        <!-- Interactive Accordion -->
        <x-ui.card title="Accordion Disclosures" description="Panel lipat untuk FAQ atau konten berjenjang">
            <div class="space-y-2">
                <!-- Accordion Item 1 -->
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-lg overflow-hidden">
                    <button 
                        type="button" 
                        @click="accordionOpen = accordionOpen === 1 ? null : 1"
                        class="w-full flex items-center justify-between p-3 text-xs font-semibold text-zinc-800 dark:text-zinc-200 bg-zinc-50/50 dark:bg-zinc-800/40 text-left cursor-pointer"
                    >
                        <span>Apakah sistem ini memerlukan Node.js di server production?</span>
                        <svg class="w-4 h-4 transform transition-transform" :class="accordionOpen === 1 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="accordionOpen === 1" class="p-3 text-xs text-zinc-600 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800">
                        Tidak. Asset di-bundle melalui Vite pada fase build, sehingga server PHP Laravel 13 hanya perlu melayani file statis CSS dan JS dari folder `public/build`.
                    </div>
                </div>

                <!-- Accordion Item 2 -->
                <div class="border border-zinc-200 dark:border-zinc-800 rounded-lg overflow-hidden">
                    <button 
                        type="button" 
                        @click="accordionOpen = accordionOpen === 2 ? null : 2"
                        class="w-full flex items-center justify-between p-3 text-xs font-semibold text-zinc-800 dark:text-zinc-200 bg-zinc-50/50 dark:bg-zinc-800/40 text-left cursor-pointer"
                    >
                        <span>Bagaimana cara memodifikasi warna aksen utama?</span>
                        <svg class="w-4 h-4 transform transition-transform" :class="accordionOpen === 2 ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="accordionOpen === 2" class="p-3 text-xs text-zinc-600 dark:text-zinc-400 border-t border-zinc-100 dark:border-zinc-800" style="display: none;">
                        Cukup ubah token warna `--color-primary` pada berkas `resources/css/app.css` atau ganti utility class `blue-600` sesuai identitas merek Anda.
                    </div>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
