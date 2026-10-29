@extends('layouts.auth', ['title' => 'Masuk ke Akun Anda'])

@section('content')
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Brand Logo -->
        <div class="text-center">
            <!-- Tambahkan justify-center di sini -->
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-2.5 group mb-6">
                <div
                    class="w-8 h-8 rounded-lg bg-[#1ca093] flex items-center justify-center text-white font-bold text-lg shadow-sm shadow-[#1ca093]/20 group-hover:bg-[#168579] transition-colors">
                    <svg class="w-5 h-5" viewBox="0 0 510 515" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M 100 10 H 485 C 495 10 500 15 500 25 V 115 C 500 125 495 130 485 130 H 260 V 190 C 260 200 255 205 245 205 H 100 C 90 205 85 200 85 190 V 25 C 85 15 90 10 100 10 Z M 25 215 C 15 215 10 220 10 230 V 320 C 10 330 15 335 25 335 H 485 C 495 335 500 330 500 320 V 230 C 500 220 495 215 485 215 H 25 Z M 85 360 C 85 350 90 345 100 345 H 245 C 255 345 260 350 260 360 V 490 C 260 500 255 505 245 505 H 100 C 90 505 85 500 85 490 V 360 Z" />
                    </svg>
                </div>
                <span class="font-bold text-zinc-900 dark:text-white text-base tracking-wide uppercase">
                    Fukuryo <span class="font-light text-[#1ca093] dark:text-[#2dd4bf]">Career</span>
                </span>
            </a>


        </div>

        <!-- Login Card (x-data sekarang sangat bersih) -->
        <div x-data="loginForm()"
            class="mt-8 rounded-2xl border border-zinc-200/80 bg-white p-6 sm:p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
            <div class="text-center mb-4">
                <h2 class="mt-0 text-2xl font-bold tracking-tight text-zinc-900 dark:text-zinc-100">
                    Welcome back
                </h2>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                    Masuk dengan Username atau Email Kamu
                </p>
            </div>

            <div class="h-0.5 w-full bg-gradient-to-r from-transparent via-[#1ca093]/30 to-transparent my-6"></div>

            <!-- Error Message (Alpine Controlled) -->
            <template x-if="errorMessage">
                <div
                    class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-xs text-red-700 dark:border-red-900/60 dark:bg-red-950/40 dark:text-red-300">
                    <div class="font-semibold">Login Gagal:</div>
                    <p class="mt-1" x-text="errorMessage"></p>
                </div>
            </template>

            <form @submit.prevent="submitForm()" class="space-y-4">

                <!-- Username or Email Input -->
                <div class="space-y-1.5 w-full">
                    <label for="login" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                        Username atau Email <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="login" x-model="loginInput" placeholder="Masukkan username atau email" required
                        autofocus
                        class="w-full rounded-lg border border-zinc-300 bg-white px-3.5 py-2 text-sm text-zinc-900 placeholder-zinc-400 hover:border-zinc-400 focus:border-[#1ca093] focus:outline-none focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder-zinc-500 dark:hover:border-zinc-600 dark:focus:border-[#2dd4bf] dark:focus:ring-[#2dd4bf]/20" />
                </div>

                <!-- Password with Show/Hide -->
                <div class="space-y-1.5 w-full">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            Kata Sandi <span class="text-red-500">*</span>
                        </label>
                        <a href="{{ route('password.request') }}"
                            class="text-xs font-medium text-[#1ca093] hover:text-[#168579] dark:text-[#2dd4bf]">
                            Lupa sandi?
                        </a>
                    </div>

                    <div class="relative rounded-lg shadow-2xs">
                        <input :type="showPassword ? 'text' : 'password'" id="password" x-model="passwordInput"
                            placeholder="••••••••" required
                            class="w-full rounded-lg border border-zinc-300 bg-white pl-3.5 pr-10 py-2 text-sm text-zinc-900 placeholder-zinc-400 hover:border-zinc-400 focus:border-[#1ca093] focus:outline-none focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder-zinc-500 dark:hover:border-zinc-600 dark:focus:border-[#2dd4bf] dark:focus:ring-[#2dd4bf]/20" />
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200"
                            tabindex="-1">
                            <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" x-model="rememberMe"
                            class="h-4 w-4 rounded border-zinc-300 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                        <span class="text-xs text-zinc-600 dark:text-zinc-400">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button type="submit" :disabled="loading"
                        class="w-full inline-flex items-center justify-center font-semibold text-sm px-4 py-2.5 rounded-lg bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] shadow-md shadow-[#1ca093]/30 cursor-pointer transition-all active:scale-95 disabled:opacity-70 disabled:cursor-not-allowed">
                        <!-- Teks Loading -->
                        <template x-if="loading">
                            <span class="flex items-center gap-2">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Authenticating...
                            </span>
                        </template>

                        <!-- Teks Normal -->
                        <template x-if="!loading">
                            <span>Masuk</span>
                        </template>
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-xs text-zinc-500 dark:text-zinc-400">
                Kembali ke <a href="{{ route('home') }}"
                    class="font-medium text-[#1ca093] hover:underline dark:text-[#2dd4bf]">Halaman Utama</a>
            </div>
        </div>
    </div>

    <!-- 🚀 PINDAHKAN LOGIKA KE SINI 🚀 -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('loginForm', () => ({
                showPassword: false,
                loading: false,
                errorMessage: '',
                loginInput: '',
                passwordInput: '',
                rememberMe: false,

                async submitForm() {
                    this.loading = true;
                    this.errorMessage = '';

                    try {
                        const response = await fetch('{{ route('login') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                login: this.loginInput,
                                password: this.passwordInput,
                                remember: this.rememberMe
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            // Jika sukses, redirect via JS
                            window.location.href = data.redirect;
                        } else {
                            // Jika gagal, tampilkan pesan error dari server
                            this.errorMessage = data.message || 'Terjadi kesalahan sistem.';
                            this.loading = false;
                        }
                    } catch (error) {
                        this.errorMessage = 'Gagal terhubung ke server. Periksa koneksi internet Anda.';
                        this.loading = false;
                    }
                }
            }));
        });
    </script>
@endsection