@extends('layouts.admin', ['title' => 'Dashboard Overview'])

@section('content')
<div>
    <!-- Page Header -->
    <x-admin.page-header 
        title="Dashboard Utama" 
        description="Ringkasan metrik kinerja aplikasi, aktivitas operasional, dan pertumbuhan pengguna."
    >
        <div class="flex items-center gap-2">
            <x-ui.button variant="secondary" size="sm">
                <svg class="w-4 h-4 mr-1 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
                <span>Unduh Laporan</span>
            </x-ui.button>
            <x-ui.button size="sm" @click="$dispatch('open-modal', 'quick-action-modal')">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Data Cepat</span>
            </x-ui.button>
        </div>
    </x-admin.page-header>

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1 -->
        <x-ui.card>
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Total Pendapatan</span>
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mt-1">Rp 128.450.000</h3>
                </div>
                <div class="p-2 rounded-lg bg-blue-50 text-blue-600 dark:bg-blue-950/60 dark:text-blue-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold">
                    ↑ +12.5%
                </span>
                <span class="text-zinc-400 dark:text-zinc-500">dibandingkan bulan lalu</span>
            </div>
        </x-ui.card>

        <!-- Card 2 -->
        <x-ui.card>
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Pelanggan Aktif</span>
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mt-1">2,480</h3>
                </div>
                <div class="p-2 rounded-lg bg-emerald-50 text-emerald-600 dark:bg-emerald-950/60 dark:text-emerald-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold">
                    ↑ +8.1%
                </span>
                <span class="text-zinc-400 dark:text-zinc-500">pengguna baru terdaftar</span>
            </div>
        </x-ui.card>

        <!-- Card 3 -->
        <x-ui.card>
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Tingkat Konversi</span>
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mt-1">4.62%</h3>
                </div>
                <div class="p-2 rounded-lg bg-purple-50 text-purple-600 dark:bg-purple-950/60 dark:text-purple-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center text-emerald-600 dark:text-emerald-400 font-semibold">
                    ↑ +1.2%
                </span>
                <span class="text-zinc-400 dark:text-zinc-500">dari kunjungan publik</span>
            </div>
        </x-ui.card>

        <!-- Card 4 -->
        <x-ui.card>
            <div class="flex items-start justify-between">
                <div>
                    <span class="text-xs font-medium text-zinc-500 dark:text-zinc-400">Tiket Terbuka</span>
                    <h3 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100 mt-1">14</h3>
                </div>
                <div class="p-2 rounded-lg bg-amber-50 text-amber-600 dark:bg-amber-950/60 dark:text-amber-400">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>
            </div>
            <div class="mt-3 flex items-center gap-1.5 text-xs">
                <span class="inline-flex items-center text-amber-600 dark:text-amber-400 font-semibold">
                    ↓ -3
                </span>
                <span class="text-zinc-400 dark:text-zinc-500">dalam antrian respon</span>
            </div>
        </x-ui.card>
    </div>

    <!-- Charts & Activity Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Visual Chart Placeholder (Flux Enterprise Style) -->
        <div class="lg:col-span-2">
            <x-ui.card title="Aktivitas Volume Transaksi" description="Tren transaksi 7 hari terakhir">
                <div class="h-64 flex flex-col justify-end pt-4">
                    <!-- Bar Chart Visual Demonstration -->
                    <div class="grid grid-cols-7 gap-3 sm:gap-6 items-end h-48 px-2 border-b border-zinc-200 dark:border-zinc-800 pb-2">
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-100 hover:bg-blue-200 dark:bg-blue-950/60 dark:hover:bg-blue-900 rounded-t-md transition-all" style="height: 45%;"></div>
                            <span class="text-[10px] text-zinc-400 font-medium">Sen</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-100 hover:bg-blue-200 dark:bg-blue-950/60 dark:hover:bg-blue-900 rounded-t-md transition-all" style="height: 60%;"></div>
                            <span class="text-[10px] text-zinc-400 font-medium">Sel</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-100 hover:bg-blue-200 dark:bg-blue-950/60 dark:hover:bg-blue-900 rounded-t-md transition-all" style="height: 75%;"></div>
                            <span class="text-[10px] text-zinc-400 font-medium">Rab</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-100 hover:bg-blue-200 dark:bg-blue-950/60 dark:hover:bg-blue-900 rounded-t-md transition-all" style="height: 50%;"></div>
                            <span class="text-[10px] text-zinc-400 font-medium">Kam</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-100 hover:bg-blue-200 dark:bg-blue-950/60 dark:hover:bg-blue-900 rounded-t-md transition-all" style="height: 90%;"></div>
                            <span class="text-[10px] text-zinc-400 font-medium">Jum</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-600 dark:bg-blue-500 rounded-t-md shadow-xs" style="height: 100%;"></div>
                            <span class="text-[10px] font-semibold text-blue-600 dark:text-blue-400">Sab</span>
                        </div>
                        <div class="flex flex-col items-center gap-2 h-full justify-end">
                            <div class="w-full bg-blue-100 hover:bg-blue-200 dark:bg-blue-950/60 dark:hover:bg-blue-900 rounded-t-md transition-all" style="height: 80%;"></div>
                            <span class="text-[10px] text-zinc-400 font-medium">Min</span>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between text-xs text-zinc-500 dark:text-zinc-400">
                        <span>Puncak transaksi: Rp 28.400.000 (Sabtu)</span>
                        <span class="flex items-center gap-1.5">
                            <span class="w-2.5 h-2.5 rounded-sm bg-blue-600"></span>
                            <span>Hari Ini / Terkini</span>
                        </span>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Recent System Logs / Activities -->
        <div>
            <x-ui.card title="Aktivitas Terkini" description="Log aksi pengguna terbaru">
                <div class="space-y-4">
                    <div class="flex items-start gap-3">
                        <x-ui.avatar initials="RS" size="sm" />
                        <div class="text-xs">
                            <p class="font-medium text-zinc-900 dark:text-zinc-100">Rina Susanti mengedit profil</p>
                            <p class="text-zinc-400 dark:text-zinc-500 text-[11px]">2 menit yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <x-ui.avatar initials="BP" size="sm" />
                        <div class="text-xs">
                            <p class="font-medium text-zinc-900 dark:text-zinc-100">Budi Pratama menambah pengguna</p>
                            <p class="text-zinc-400 dark:text-zinc-500 text-[11px]">18 menit yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <x-ui.avatar initials="AD" size="sm" />
                        <div class="text-xs">
                            <p class="font-medium text-zinc-900 dark:text-zinc-100">Admin mengekspor audit log</p>
                            <p class="text-zinc-400 dark:text-zinc-500 text-[11px]">1 jam yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <x-ui.avatar initials="DH" size="sm" />
                        <div class="text-xs">
                            <p class="font-medium text-zinc-900 dark:text-zinc-100">Dewi Hartati memperbarui API key</p>
                            <p class="text-zinc-400 dark:text-zinc-500 text-[11px]">3 jam yang lalu</p>
                        </div>
                    </div>
                </div>

                <x-slot:footer>
                    <a href="{{ route('admin.users.index') ?? '/admin/users' }}" class="text-xs font-medium text-blue-600 hover:underline dark:text-blue-400">
                        Lihat Semua Riwayat →
                    </a>
                </x-slot:footer>
            </x-ui.card>
        </div>
    </div>

    <!-- Quick Action Modal Demo -->
    <x-ui.modal name="quick-action-modal" title="Buat Entri Cepat" description="Form simulasi entri cepat modal Alpine.js">
        <form class="space-y-3" @submit.prevent="$dispatch('close-modal', 'quick-action-modal'); $store.toasts.add({ title: 'Berhasil', message: 'Data baru berhasil ditambahkan.', type: 'success' })">
            <x-ui.input name="quick_title" label="Judul Entri" placeholder="Masukkan judul..." required="true" />
            <x-ui.select name="quick_category" label="Kategori" :options="['sales' => 'Penjualan', 'support' => 'Dukungan Teknis', 'marketing' => 'Pemasaran']" />
            <div class="pt-4 flex justify-end gap-2">
                <x-ui.button type="button" variant="secondary" size="sm" @click="$dispatch('close-modal', 'quick-action-modal')">Batal</x-ui.button>
                <x-ui.button type="submit" size="sm">Simpan Entri</x-ui.button>
            </div>
        </form>
    </x-ui.modal>
</div>
@endsection
