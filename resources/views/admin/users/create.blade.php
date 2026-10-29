@extends('layouts.admin', ['title' => 'Tambah Pengguna Baru'])

@section('content')
<div class="max-w-3xl" x-data="{ saving: false }">
    <x-admin.page-header 
        title="Tambah Pengguna Baru" 
        description="Daftarkan akun anggota tim baru dan tentukan hak akses peran sistem."
        :breadcrumbs="['Pengguna' => route('admin.users.index') ?? '/admin/users', 'Tambah Baru' => null]"
    />

    <x-ui.card>
        <form 
            method="POST" 
            action="{{ route('admin.users.store') ?? '#' }}" 
            @submit.prevent="saving = true; setTimeout(() => { saving = false; $store.toasts.add({ title: 'Pengguna Dibuat', message: 'Akun baru telah berhasil didaftarkan.', type: 'success' }); window.location.href = '{{ route('admin.users.index') ?? '/admin/users' }}' }, 800)"
            class="space-y-6"
        >
            @csrf

            <!-- Personal Data Section -->
            <div class="space-y-4">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 border-b border-zinc-100 dark:border-zinc-800 pb-2">
                    Informasi Akun
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.input
                        name="name"
                        label="Nama Lengkap"
                        placeholder="Contoh: Budi Pratama"
                        required="true"
                    />

                    <x-ui.input
                        name="email"
                        type="email"
                        label="Alamat Email"
                        placeholder="budi@perusahaan.com"
                        required="true"
                    />
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.select
                        name="role"
                        label="Peran Akun (Role)"
                        :options="['admin' => 'Super Admin', 'manager' => 'Product Manager', 'staff' => 'Staff Developer', 'viewer' => 'Read-Only Viewer']"
                        required="true"
                    />

                    <x-ui.select
                        name="department"
                        label="Departemen"
                        :options="['Engineering' => 'Engineering', 'Product' => 'Product', 'Design' => 'UI/UX Design', 'Finance' => 'Finance & HR']"
                        required="true"
                    />
                </div>
            </div>

            <!-- Password Setup Section -->
            <div class="space-y-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 border-b border-zinc-100 dark:border-zinc-800 pb-2">
                    Kredensial Keamanan
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.input
                        name="password"
                        type="password"
                        label="Kata Sandi Awal"
                        placeholder="Minimal 8 karakter"
                        required="true"
                    />

                    <x-ui.input
                        name="password_confirmation"
                        type="password"
                        label="Konfirmasi Kata Sandi"
                        placeholder="Ulangi kata sandi"
                        required="true"
                    />
                </div>

                <div class="pt-2">
                    <x-ui.checkbox
                        name="send_invite_email"
                        label="Kirim email undangan aktivasi dengan instruksi login"
                        checked="true"
                    />
                </div>
            </div>

            <!-- Form Action Footer -->
            <div class="pt-6 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-3">
                <x-ui.button href="{{ route('admin.users.index') ?? '/admin/users' }}" variant="secondary">
                    Batal
                </x-ui.button>
                <x-ui.button type="submit" ::loading="saving">
                    Simpan & Buat Akun
                </x-ui.button>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
