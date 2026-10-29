@extends('layouts.auth', ['title' => 'Lupa Kata Sandi'])

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
            Lupa Kata Sandi?
        </h2>
        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto">
            Masukkan alamat email yang terdaftar untuk menerima tautan pemulihan kata sandi.
        </p>
    </div>

    <div 
        x-data="{ 
            sent: false, 
            submitting: false,
            submitReset() {
                this.submitting = true;
                setTimeout(() => {
                    this.submitting = false;
                    this.sent = true;
                    $store.toasts.add({ title: 'Tautan Terkirim', message: 'Tautan reset password telah dikirim ke email Anda.', type: 'info' });
                }, 800);
            }
        }"
        class="mt-8 rounded-2xl border border-zinc-200/80 bg-white p-6 sm:p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900"
    >
        <div x-show="sent" class="text-center space-y-3" style="display: none;">
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-950 dark:text-blue-400 mx-auto flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Periksa Email Anda</p>
            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                Kami telah mengirimkan instruksi ke email yang Anda masukkan.
            </p>
            <div class="pt-2">
                <a href="{{ route('password.reset', ['token' => 'demo-token']) ?? '/reset-password' }}" class="text-xs text-blue-600 hover:underline dark:text-blue-400">
                    → Lanjut ke simulasi Reset Password Form
                </a>
            </div>
        </div>

        <form x-show="!sent" method="POST" action="{{ route('password.email') ?? '#' }}" @submit.prevent="submitReset()" class="space-y-4">
            @csrf

            <x-ui.input
                name="email"
                type="email"
                label="Alamat Email Terdaftar"
                placeholder="nama@perusahaan.com"
                required="true"
                helper="Kami tidak akan pernah membagikan email Anda kepada pihak ketiga."
            />

            <div class="pt-2">
                <x-ui.button type="submit" size="md" class="w-full justify-center" ::loading="submitting">
                    Kirim Tautan Reset
                </x-ui.button>
            </div>
        </form>

        <div class="mt-6 text-center text-xs text-zinc-500 dark:text-zinc-400">
            Ingat kata sandi Anda? <a href="{{ route('login') ?? '/login' }}" class="font-medium text-blue-600 hover:underline dark:text-blue-400">Kembali ke Login</a>
        </div>
    </div>
</div>
@endsection
