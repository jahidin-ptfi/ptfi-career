@extends('layouts.auth', ['title' => 'Buat Kata Sandi Baru'])

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="text-center">
        <a href="{{ route('home') ?? '/' }}" class="inline-flex items-center gap-2.5">
            <div class="w-10 h-10 rounded-xl bg-blue-600 flex items-center justify-center text-white font-bold text-lg shadow-sm shadow-blue-500/20">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
        </a>
        <h2 class="mt-4 text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
            Setel Ulang Kata Sandi
        </h2>
        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
            Buat kombinasi kata sandi baru yang kuat untuk akun Anda
        </p>
    </div>

    <div 
        x-data="{ 
            submitting: false,
            handleReset() {
                this.submitting = true;
                setTimeout(() => {
                    this.submitting = false;
                    $store.toasts.add({ title: 'Sandi Berhasil Diubah', message: 'Silakan masuk menggunakan kata sandi baru Anda.', type: 'success' });
                    window.location.href = '{{ route('login') ?? '/login' }}';
                }, 800);
            }
        }"
        class="mt-8 rounded-2xl border border-zinc-200/80 bg-white p-6 sm:p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
    >
        <form method="POST" action="{{ route('password.update') ?? '#' }}" @submit.prevent="handleReset()" class="space-y-4">
            @csrf

            <!-- Hidden Token for Laravel Password Broker -->
            <input type="hidden" name="token" value="{{ $token ?? 'demo-reset-token' }}">

            <x-ui.input
                name="email"
                type="email"
                label="Alamat Email"
                value="admin@fluxblade.internal"
                required="true"
                readonly="true"
            />

            <x-ui.input
                name="password"
                type="password"
                label="Kata Sandi Baru"
                placeholder="Minimal 8 karakter unik"
                required="true"
                helper="Gunakan minimal 8 karakter dengan perpaduan huruf, angka, & simbol."
            />

            <x-ui.input
                name="password_confirmation"
                type="password"
                label="Konfirmasi Kata Sandi Baru"
                placeholder="Ulangi kata sandi baru"
                required="true"
            />

            <div class="pt-2">
                <x-ui.button type="submit" size="md" class="w-full justify-center" ::loading="submitting">
                    Perbarui Kata Sandi
                </x-ui.button>
            </div>
        </form>

        <div class="mt-6 text-center text-xs text-zinc-500 dark:text-zinc-400">
            Batal mengatur ulang? <a href="{{ route('login') ?? '/login' }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">Kembali ke Login</a>
        </div>
    </div>
</div>
@endsection
