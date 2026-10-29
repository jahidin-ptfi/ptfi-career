@extends('layouts.admin', ['title' => 'Edit Pengguna — Budi Pratama'])

@section('content')
<div class="max-w-3xl" x-data="{ saving: false }">
    <x-admin.page-header 
        title="Edit Data Pengguna" 
        description="Perbarui informasi akun, hak akses departemen, atau status aktif pengguna."
        :breadcrumbs="['Pengguna' => route('admin.users.index') ?? '/admin/users', 'Edit' => null]"
    />

    <x-ui.card>
        <form 
            method="POST" 
            action="{{ route('admin.users.update', ['user' => 1]) ?? '#' }}" 
            @submit.prevent="saving = true; setTimeout(() => { saving = false; $store.toasts.add({ title: 'Perubahan Disimpan', message: 'Data pengguna berhasil diperbarui.', type: 'success' }); window.location.href = '{{ route('admin.users.index') ?? '/admin/users' }}' }, 800)"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="flex items-center gap-3 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <x-ui.avatar initials="BP" size="lg" />
                    <div>
                        <h4 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Budi Pratama</h4>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Terdaftar sejak 24 Okt 2026</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.input
                        name="name"
                        label="Nama Lengkap"
                        value="Budi Pratama"
                        required="true"
                    />

                    <x-ui.input
                        name="email"
                        type="email"
                        label="Alamat Email"
                        value="budi.pratama@example.com"
                        required="true"
                    />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.select
                        name="role"
                        label="Peran Akun"
                        :options="['admin' => 'Super Admin', 'manager' => 'Product Manager', 'staff' => 'Staff Developer']"
                        selected="admin"
                        required="true"
                    />

                    <x-ui.select
                        name="status"
                        label="Status Akun"
                        :options="['active' => 'Aktif', 'inactive' => 'Nonaktif', 'pending' => 'Menunggu Verifikasi']"
                        selected="active"
                        required="true"
                    />
                </div>

                <div class="pt-2">
                    <x-ui.switch
                        name="two_factor_required"
                        label="Wajibkan Autentikasi Dua Faktor (2FA)"
                        description="Pengguna harus memverifikasi kode OTP saat login"
                        checked="true"
                    />
                </div>
            </div>

            <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-3">
                <x-ui.button href="{{ route('admin.users.index') ?? '/admin/users' }}" variant="secondary">
                    Batal
                </x-ui.button>
                <x-ui.button type="submit" ::loading="saving">
                    Simpan Perubahan
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
