<!-- Bungkus dengan div utama -->
<div x-data="{ mobileMenuOpen: false, userMenuOpen: false }">

    <!-- HEADER -->
    <header
        class="sticky top-0 z-40 w-full border-b border-zinc-200/80 bg-white/80 backdrop-blur-md dark:border-zinc-800 dark:bg-zinc-950/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                <!-- 1. BAGIAN KIRI: Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
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

                <!-- 2. BAGIAN TENGAH: Menu Navigasi (Desktop) -->
                <nav class="hidden md:flex flex-1 justify-center items-center gap-6 text-sm font-medium">
                    <a href="{{ route('home') }}"
                        class="transition-colors {{ request()->routeIs('home') || request()->is('/') ? 'text-[#1ca093] dark:text-[#2dd4bf] font-semibold' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100' }}">Lowongan</a>
                    <a href="{{ route('candidate.applications') ?? '/profile/applications' }}"
                        class="transition-colors {{ request()->is('profile/applications*') ? 'text-[#1ca093] dark:text-[#2dd4bf] font-semibold' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100' }}">Lamaran
                        saya</a>
                    <a href="{{ route('about') ?? '/about' }}"
                        class="transition-colors {{ request()->routeIs('about') ? 'text-[#1ca093] dark:text-[#2dd4bf] font-semibold' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100' }}">Tentang
                        fukuryo</a>
                    <a href="{{ route('about') ?? '/about' }}"
                        class="transition-colors {{ request()->routeIs('about') ? 'text-[#1ca093] dark:text-[#2dd4bf] font-semibold' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100' }}">Bantuan</a>
                </nav>

                <!-- 3. BAGIAN KANAN: Action Buttons (Desktop) -->
                <div class="hidden md:flex items-center gap-3 shrink-0">
                    <x-ui.theme-toggle />

                    @guest
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center font-semibold text-xs px-4 py-2 rounded-lg bg-[#1ca093] text-white hover:bg-[#168579] shadow-sm transition-colors">Masuk
                            / Login</a>
                    @endguest

                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" type="button"
                                class="flex items-center gap-2 p-1.5 rounded-lg text-xs font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800 transition-colors focus:outline-none">
                                @if(auth()->user()->profile && auth()->user()->profile->foto)
                                    <img src="{{ asset('storage/uploads/' . auth()->user()->profile->foto) }}" alt="Foto Profil"
                                        class="w-6 h-6 rounded-full object-cover border border-zinc-200 dark:border-zinc-700">
                                @else
                                    <div
                                        class="w-6 h-6 rounded-full bg-zinc-200 dark:bg-zinc-700 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-zinc-500 dark:text-zinc-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif
                                <span>{{ auth()->user()->name ?? auth()->user()->username }}</span>
                                <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-transition
                                class="absolute right-0 mt-2 w-48 rounded-xl bg-white shadow-lg border border-zinc-200 dark:border-zinc-800 dark:bg-zinc-900 py-1 z-50"
                                style="display: none;">
                                <a href="{{ route('candidate.profile') ?? '/profile' }}"
                                    class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">Profil
                                    Saya</a>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') ?? '/admin' }}"
                                        class="block px-4 py-2 text-sm text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">Dashboard
                                        Admin</a>
                                @endif
                                <div class="border-t border-zinc-200 dark:border-zinc-800 my-1"></div>

                                <!-- Trigger Modal via dispatch -->
                                <button type="button" @click="open = false; $dispatch('open-modal', 'logout-modal')"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30">Keluar
                                    (Logout)</button>
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- 4. MOBILE HAMBURGER TOGGLE -->
                <div class="flex items-center gap-2 md:hidden">
                    <x-ui.theme-toggle />
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-lg text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- 5. MOBILE DROPDOWN NAVIGATION -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden border-b border-zinc-200 bg-white px-4 pt-2 pb-6 space-y-2 dark:border-zinc-800 dark:bg-zinc-900"
            style="display: none;">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('home') || request()->is('/') ? 'bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] font-semibold' : 'text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800' }}">Cari
                Lowongan</a>
            <a href="{{ route('candidate.applications') ?? '/profile/applications' }}"
                class="block px-3 py-2 rounded-lg text-base font-medium transition-colors {{ request()->is('profile/applications*') ? 'bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] font-semibold' : 'text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800' }}">Lamaran
                saya</a>
            <a href="{{ route('about') ?? '/about' }}"
                class="block px-3 py-2 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('about') ? 'bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] font-semibold' : 'text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800' }}">Tentang
                fukuryo</a>
            <a href="{{ route('about') ?? '/about' }}"
                class="block px-3 py-2 rounded-lg text-base font-medium transition-colors {{ request()->routeIs('about') ? 'bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] font-semibold' : 'text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800' }}">Bantuan</a>

            <div class="pt-4 border-t border-zinc-200 dark:border-zinc-800 flex flex-col gap-2">
                @guest
                    <x-ui.button href="{{ route('login') }}" class="w-full justify-center">Masuk / Login</x-ui.button>
                @endguest
                @auth
                    <a href="{{ route('candidate.profile') ?? '/profile' }}"
                        class="block text-center px-3 py-2 rounded-lg text-sm font-medium border border-zinc-300 text-zinc-700 dark:border-zinc-700 dark:text-zinc-300">Profil
                        Akun Saya</a>
                    @if(auth()->user()->role === 'admin')
                        <x-ui.button href="{{ route('admin.dashboard') ?? '/admin' }}" class="w-full justify-center">Dashboard
                            Admin</x-ui.button>
                    @endif

                    <!-- Trigger Modal via dispatch -->
                    <button type="button" @click="mobileMenuOpen = false; $dispatch('open-modal', 'logout-modal')"
                        class="w-full text-center px-3 py-2 rounded-lg text-sm font-medium bg-red-50 text-red-600 dark:bg-red-950/30 dark:text-red-400">Keluar
                        (Logout)</button>
                @endauth
            </div>
        </div>
    </header>

    <!-- 6. MODAL KONFIRMASI LOGOUT MENGGUNAKAN KOMPONEN -->
    <x-ui.modal name="logout-modal" maxWidth="sm">

        <!-- Konten Modal (dibungkus x-data agar bisa fetch API) -->
        <div x-data="{
            loading: false,
            error: '',
            async submitLogout() {
                this.loading = true;
                this.error = '';
                try {
                    const response = await fetch('{{ route('logout') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });
                    const data = await response.json();
                    if (response.ok) {
                        window.location.href = data.redirect;
                    } else {
                        this.error = data.message || 'Gagal logout. Coba lagi.';
                        this.loading = false;
                    }
                } catch (e) {
                    this.error = 'Koneksi terputus. Periksa internet Anda.';
                    this.loading = false;
                }
            }
        }" class="text-center">

            <div
                class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 dark:bg-red-950/50 mb-4">
                <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>

            <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Konfirmasi Keluar</h3>
            <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">Apakah Anda yakin ingin keluar dari akun Anda? Anda
                harus login kembali untuk melamar pekerjaan.</p>

            <template x-if="error">
                <div class="mt-3 text-xs text-red-600 font-semibold" x-text="error"></div>
            </template>

            <!-- Tombol diletakkan di dalam konten modal -->
            <div class="mt-6 flex items-center justify-center gap-3">
                <button type="button" @click="$dispatch('close-modal', 'logout-modal')" :disabled="loading"
                    class="px-4 py-2 text-xs font-medium text-zinc-700 bg-zinc-100 hover:bg-zinc-200 rounded-lg dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700 transition-colors disabled:opacity-50">
                    Batal
                </button>

                <button type="button" @click="submitLogout()" :disabled="loading"
                    class="px-4 py-2 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg shadow-sm transition-colors disabled:opacity-70 flex items-center justify-center gap-2 min-w-[100px]">
                    <template x-if="loading">
                        <svg class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </template>
                    <span x-text="loading ? 'Keluar...' : 'Ya, Keluar'"></span>
                </button>
            </div>
        </div>

    </x-ui.modal>

</div> <!-- Penutup div x-data utama -->