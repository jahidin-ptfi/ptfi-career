@extends('layouts.admin', ['title' => 'Detail Pengguna — Budi Pratama'])

@section('content')
<div class="max-w-4xl">
    <x-admin.page-header 
        title="Detail Pengguna" 
        description="Ringkasan profil, status perizinan, dan catatan aktivitas pengguna."
        :breadcrumbs="['Pengguna' => route('admin.users.index') ?? '/admin/users', 'Detail' => null]"
    >
        <div class="flex items-center gap-2">
            <x-ui.button href="{{ route('admin.users.edit', ['user' => 1]) ?? '/admin/users/1/edit' }}" variant="secondary" size="sm">
                <svg class="w-4 h-4 mr-1 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                <span>Edit Akun</span>
            </x-ui.button>
            <x-ui.button href="{{ route('admin.users.index') ?? '/admin/users' }}" variant="outline" size="sm">
                Kembali
            </x-ui.button>
        </div>
    </x-admin.page-header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Overview Card -->
        <div class="lg:col-span-1">
            <x-ui.card>
                <div class="flex flex-col items-center text-center pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <x-ui.avatar initials="BP" size="xl" status="online" />
                    <h3 class="mt-3 text-base font-semibold text-zinc-900 dark:text-zinc-100">Budi Pratama</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400">budi.pratama@example.com</p>
                    <div class="mt-3">
                        <x-ui.badge variant="primary" dot="true">Super Admin</x-ui.badge>
                    </div>
                </div>

                <div class="mt-4 space-y-3 text-xs">
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Departemen</span>
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">Engineering</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Status Akun</span>
                        <x-ui.badge variant="success" size="sm" dot="true">Aktif</x-ui.badge>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Tanggal Bergabung</span>
                        <span class="text-zinc-700 dark:text-zinc-300">24 Okt 2026</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-500 dark:text-zinc-400">Terakhir Login</span>
                        <span class="text-zinc-700 dark:text-zinc-300">Hari ini, 14:22 WIB</span>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Detail Information & Activity -->
        <div class="lg:col-span-2 space-y-6">
            <x-ui.card title="Hak Akses & Perizinan" description="Izin fungsional yang diberikan kepada pengguna ini">
                <div class="grid grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-lg border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-800/30 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Kelola Pengguna & Peran</span>
                    </div>
                    <div class="p-3 rounded-lg border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-800/30 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Ekspor & Impor Data</span>
                    </div>
                    <div class="p-3 rounded-lg border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-800/30 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Konfigurasi Sistem</span>
                    </div>
                    <div class="p-3 rounded-lg border border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-800/30 flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span>Akses Audit Trail Log</span>
                    </div>
                </div>
            </x-ui.card>

            <x-ui.card title="Log Aktivitas Pengguna" description="Daftar tindakan terbaru yang dilakukan oleh pengguna ini">
                <div class="space-y-3 text-xs">
                    <div class="flex items-center justify-between py-2 border-b border-zinc-100 dark:border-zinc-800">
                        <div>
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">Login ke Dashboard</span>
                            <span class="text-zinc-400 block text-[11px]">IP: 182.253.110.42 (Chrome on macOS)</span>
                        </div>
                        <span class="text-zinc-400">14:22</span>
                    </div>
                    <div class="flex items-center justify-between py-2 border-b border-zinc-100 dark:border-zinc-800">
                        <div>
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">Memperbarui Konfigurasi Sistem</span>
                            <span class="text-zinc-400 block text-[11px]">Modul Pengaturan Umum</span>
                        </div>
                        <span class="text-zinc-400">11:05</span>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </div>
</div>
@endsection
