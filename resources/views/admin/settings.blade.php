@extends('layouts.admin', ['title' => 'Pengaturan Sistem'])

@section('content')
<div class="max-w-4xl" x-data="{ activeTab: 'general' }">
    <x-admin.page-header 
        title="Pengaturan Sistem" 
        description="Konfigurasi preferensi global antarmuka, bahasa sistem, dan saluran notifikasi."
        :breadcrumbs="['Pengaturan' => null]"
    />

    <!-- Tabs Navigation -->
    <div class="border-b border-zinc-200 dark:border-zinc-800 mb-6">
        <nav class="flex space-x-6 text-sm font-medium">
            <button
                type="button"
                @click="activeTab = 'general'"
                :class="activeTab === 'general' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400 font-semibold' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="pb-3 border-b-2 transition-colors cursor-pointer"
            >
                Umum & Organisasi
            </button>
            <button
                type="button"
                @click="activeTab = 'appearance'"
                :class="activeTab === 'appearance' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400 font-semibold' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="pb-3 border-b-2 transition-colors cursor-pointer"
            >
                Tampilan & Tema
            </button>
            <button
                type="button"
                @click="activeTab = 'notifications'"
                :class="activeTab === 'notifications' ? 'border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-400 font-semibold' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="pb-3 border-b-2 transition-colors cursor-pointer"
            >
                Notifikasi
            </button>
        </nav>
    </div>

    <!-- Tab 1: General -->
    <div x-show="activeTab === 'general'" class="space-y-6">
        <x-ui.card title="Informasi Aplikasi" description="Parameter dasar aplikasi Laravel 13 Anda">
            <form class="space-y-4" @submit.prevent="$store.toasts.add({ title: 'Tersimpan', message: 'Pengaturan umum berhasil disimpan.', type: 'success' })">
                <x-ui.input
                    name="app_name"
                    label="Nama Aplikasi"
                    value="FluxBlade Enterprise"
                    required="true"
                />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.select
                        name="default_language"
                        label="Bahasa Sistem"
                        :options="['id' => 'Bahasa Indonesia (id)', 'en' => 'English (en)']"
                        selected="id"
                    />

                    <x-ui.select
                        name="timezone"
                        label="Zona Waktu (Timezone)"
                        :options="['Asia/Jakarta' => 'Asia/Jakarta (WIB)', 'Asia/Makassar' => 'Asia/Makassar (WITA)', 'Asia/Jayapura' => 'Asia/Jayapura (WIT)']"
                        selected="Asia/Jakarta"
                    />
                </div>

                <div class="pt-2 flex justify-end">
                    <x-ui.button type="submit">Simpan Pengaturan</x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>

    <!-- Tab 2: Appearance -->
    <div x-show="activeTab === 'appearance'" class="space-y-6" style="display: none;">
        <x-ui.card title="Preferensi Tampilan" description="Pilih tema tampilan antarmuka yang paling nyaman untuk Anda">
            <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-3">
                        Mode Tema
                    </label>
                    <div class="grid grid-cols-3 gap-3 max-w-md">
                        <!-- Light Mode -->
                        <button
                            type="button"
                            @click="$store.theme.set('light')"
                            :class="$store.theme.current === 'light' ? 'border-blue-600 ring-2 ring-blue-500/20' : 'border-zinc-200 dark:border-zinc-800'"
                            class="p-3 text-center rounded-xl border bg-white dark:bg-zinc-900 transition-all cursor-pointer"
                        >
                            <div class="w-6 h-6 mx-auto mb-2 text-amber-500">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Light</span>
                        </button>

                        <!-- Dark Mode -->
                        <button
                            type="button"
                            @click="$store.theme.set('dark')"
                            :class="$store.theme.current === 'dark' ? 'border-blue-600 ring-2 ring-blue-500/20' : 'border-zinc-200 dark:border-zinc-800'"
                            class="p-3 text-center rounded-xl border bg-white dark:bg-zinc-900 transition-all cursor-pointer"
                        >
                            <div class="w-6 h-6 mx-auto mb-2 text-blue-400">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                            </div>
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Dark</span>
                        </button>

                        <!-- System Mode -->
                        <button
                            type="button"
                            @click="$store.theme.set('system')"
                            :class="$store.theme.current === 'system' ? 'border-blue-600 ring-2 ring-blue-500/20' : 'border-zinc-200 dark:border-zinc-800'"
                            class="p-3 text-center rounded-xl border bg-white dark:bg-zinc-900 transition-all cursor-pointer"
                        >
                            <div class="w-6 h-6 mx-auto mb-2 text-zinc-400">
                                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            </div>
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">System</span>
                        </button>
                    </div>
                </div>

                <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
                    <x-ui.switch
                        name="compact_mode"
                        label="Mode Kepadatan Tabel (Compact Table)"
                        description="Kecilkan padding cell pada tabel data untuk melihat lebih banyak baris"
                        checked="false"
                    />
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Tab 3: Notifications -->
    <div x-show="activeTab === 'notifications'" class="space-y-6" style="display: none;">
        <x-ui.card title="Preferensi Notifikasi" description="Atur kapan dan bagaimana Anda ingin menerima pemberitahuan">
            <div class="space-y-4">
                <x-ui.switch
                    name="notify_new_user"
                    label="Pendaftaran Pengguna Baru"
                    description="Kirim notifikasi email ketika ada akun baru terdaftar"
                    checked="true"
                />

                <x-ui.switch
                    name="notify_weekly_report"
                    label="Laporan Ringkasan Mingguan"
                    description="Kirim ringkasan otomatis setiap hari Senin pukul 08.00"
                    checked="true"
                />

                <x-ui.switch
                    name="notify_security"
                    label="Peringatan Keamanan & Login Baru"
                    description="Notifikasi instan jika terdeteksi login dari IP baru"
                    checked="true"
                />
            </div>
        </x-ui.card>
    </div>
</div>
@endsection
