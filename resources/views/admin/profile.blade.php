@extends('layouts.admin', ['title' => 'Profil Pengguna'])

@section('content')
<div class="max-w-4xl">
    <x-admin.page-header 
        title="Profil Pengguna" 
        description="Kelola informasi identitas pribadi, foto profil, dan kredensial keamanan akun Anda."
        :breadcrumbs="['Pengguna' => route('admin.users.index') ?? '/admin/users', 'Profil' => null]"
    />

    <div class="space-y-6" x-data="{ saving: false }">
        <!-- Profile Identity Card -->
        <x-ui.card title="Informasi Pribadi" description="Perbarui nama lengkap dan kontak email terverifikasi">
            <form 
                method="POST" 
                action="{{ route('admin.profile.update') ?? '#' }}" 
                @submit.prevent="saving = true; setTimeout(() => { saving = false; $store.toasts.add({ title: 'Profil Diperbarui', message: 'Informasi akun Anda berhasil disimpan.', type: 'success' }) }, 700)" 
                class="space-y-5"
            >
                @csrf
                @method('PUT')

                <!-- Avatar Section -->
                <div class="flex items-center gap-4 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                    <x-ui.avatar initials="AD" size="xl" status="online" />
                    <div>
                        <h4 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Foto Profil</h4>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">JPG, GIF, atau PNG. Maksimal 2MB.</p>
                        <div class="mt-2 flex gap-2">
                            <x-ui.button type="button" variant="secondary" size="sm">Ubah Foto</x-ui.button>
                            <x-ui.button type="button" variant="ghost" size="sm" class="text-red-600 hover:text-red-700 dark:text-red-400">Hapus</x-ui.button>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.input
                        name="name"
                        label="Nama Lengkap"
                        value="Admin Demo"
                        placeholder="Masukkan nama lengkap"
                        required="true"
                    />

                    <x-ui.input
                        name="username"
                        label="Nama Pengguna (Username)"
                        value="admindemo"
                        placeholder="admindemo"
                        prefix="@"
                        required="true"
                    />
                </div>

                <x-ui.input
                    name="email"
                    type="email"
                    label="Alamat Email"
                    value="admin@fluxblade.internal"
                    placeholder="nama@perusahaan.com"
                    required="true"
                    helper="Email ini digunakan untuk notifikasi sistem dan login."
                />

                <div class="pt-2 flex justify-end">
                    <x-ui.button type="submit" ::loading="saving">
                        Simpan Perubahan
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>

        <!-- Change Password Card -->
        <x-ui.card title="Keamanan Kata Sandi" description="Pastikan akun Anda terlindungi dengan kombinasi sandi yang kuat">
            <form 
                method="POST" 
                action="{{ route('admin.password.update') ?? '#' }}" 
                @submit.prevent="$store.toasts.add({ title: 'Kata Sandi Diperbarui', message: 'Sandi baru berhasil diaktifkan.', type: 'success' })" 
                class="space-y-4"
            >
                @csrf
                @method('PUT')

                <x-ui.input
                    name="current_password"
                    type="password"
                    label="Kata Sandi Saat Ini"
                    placeholder="••••••••"
                    required="true"
                />

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.input
                        name="new_password"
                        type="password"
                        label="Kata Sandi Baru"
                        placeholder="Minimal 8 karakter"
                        required="true"
                    />

                    <x-ui.input
                        name="new_password_confirmation"
                        type="password"
                        label="Ulangi Sandi Baru"
                        placeholder="Ulangi sandi baru"
                        required="true"
                    />
                </div>

                <div class="pt-2 flex justify-end">
                    <x-ui.button type="submit" variant="secondary">
                        Perbarui Kata Sandi
                    </x-ui.button>
                </div>
            </form>
        </x-ui.card>
    </div>
</div>
@endsection
