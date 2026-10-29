<footer class="border-t border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-950 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-12">
        <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
            <div class="col-span-2">
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') ?? '/' }}" class="flex items-center gap-2.5 group">
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
                <p class="mt-3 text-xs leading-relaxed text-zinc-500 dark:text-zinc-400 max-w-sm">
                    Platform portal karier dan rekrutmen resmi PT Fukuryo Indonesia.
                </p>
                <span class="text-xs text-zinc-400 dark:text-zinc-500">© {{ date('Y') }} Fukuryo career portal. Hak
                    cipta dilindungi.</span>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-zinc-900 dark:text-zinc-100">Karier</h4>
                <ul class="mt-3 space-y-2 text-xs text-zinc-600 dark:text-zinc-400">
                    <li><a href="{{ route('home') ?? '/' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Cari Lowongan</a>
                    </li>
                    <li><a href="{{ route('candidate.applications') ?? '/profile/applications' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Lamaran Saya</a>
                    </li>
                    <li><a href="{{ route('candidate.profile') ?? '/profile' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Profil Kandidat</a>
                    </li>
                    <li><a href="{{ route('pricing') ?? '/pricing' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Pasang Lowongan</a>
                    </li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-zinc-900 dark:text-zinc-100">Perusahaan
                </h4>
                <ul class="mt-3 space-y-2 text-xs text-zinc-600 dark:text-zinc-400">
                    <li><a href="{{ route('about') ?? '/about' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Tentang Kami</a>
                    </li>
                    <li><a href="{{ route('contact') ?? '/contact' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Hubungi Kami</a>
                    </li>
                    <li><a href="#" class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Kebijakan
                            Privasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-xs font-semibold uppercase tracking-wider text-zinc-900 dark:text-zinc-100">Portal</h4>
                <ul class="mt-3 space-y-2 text-xs text-zinc-600 dark:text-zinc-400">
                    <li><a href="{{ route('admin.dashboard') ?? '/admin' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Dashboard Admin</a>
                    </li>
                    <li><a href="{{ route('admin.examples.form') ?? '/admin/examples/form-elements' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Design System
                            UI</a></li>
                    <li><a href="{{ route('login') ?? '/login' }}"
                            class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Masuk Akun</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>