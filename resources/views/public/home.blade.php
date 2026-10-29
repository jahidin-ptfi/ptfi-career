@extends('layouts.public', ['title' => 'Portal Lowongan Kerja Enterprise — Temukan Karier Impian'])

@section('content')
    <!-- Tambahkan CDN tsParticles (Versi modern dari particles.js) -->
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.12.0/tsparticles.bundle.min.js"></script>

    <div x-data="careerPortal()" class="pb-16">

        <!-- MODERN HERO SECTION: GRADIENT, PARTICLES, & SPLIT LAYOUT -->
        <section
            class="relative overflow-hidden pt-10 pb-10 md:pt-10 md:pb-12 border-b border-zinc-200/80 dark:border-zinc-800 transition-colors">

            <!-- 1. Background Gradient (Identik dengan warna brand #1ca093) -->
            <div
                class="absolute inset-0 bg-gradient-to-br from-white via-[#e7f6f3]/60 to-[#c4eae3]/30 dark:from-zinc-950 dark:via-[#1ca093]/10 dark:to-zinc-950 z-0">
            </div>

            <!-- 2. Particles.js Container -->
            <div id="tsparticles" class="absolute inset-0 z-0 pointer-events-none"></div>

            <!-- 3. Konten Utama -->
            <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">

                    <!-- KOLOM KIRI: Teks & Search -->
                    <div class="text-center lg:text-left">
                        <!-- Brand Badge Pill -->
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-white/80 backdrop-blur-sm text-[#168579] border border-[#1ca093]/30 dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] dark:border-[#1ca093]/30 mb-6 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-[#1ca093] animate-pulse"></span>
                            <span>{{ $jobs->count() }} Lowongan Terverifikasi Aktif Hari Ini</span>
                        </div>

                        <!-- Headline -->
                        <h1
                            class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight text-zinc-900 dark:text-white leading-[1.15]">
                            Temukan peluang <br class="hidden lg:block" />
                            karier di <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-[#1ca093] to-[#2dd4bf]"> PT
                                Fukuryo
                                Indonesia</span>
                        </h1>

                        <p class="mt-4 text-sm sm:text-base text-zinc-600 dark:text-zinc-400 max-w-lg mx-auto lg:mx-0">
                            Jelajahi kesempatan berkarir bersama kami dan jadilah bagian dari tim yang
                            berkomitmen terhadap kualitas, profesionalisme, dan pertumbuhan bersama.
                        </p>

                        <!-- Search Bar Card (Glassmorphism Effect) -->
                        <div
                            class="mt-8 p-4 rounded-2xl border border-white/40 bg-white/60 backdrop-blur-xl shadow-xl shadow-[#1ca093]/5 dark:border-zinc-700/50 dark:bg-zinc-900/60 dark:shadow-none text-left">
                            <form @submit.prevent class="grid grid-cols-1 sm:grid-cols-12 gap-2">
                                <!-- Keyword input -->
                                <div class="sm:col-span-9 relative">
                                    <div
                                        class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-zinc-400">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>

                                    <input type="text" x-model="keyword"
                                        placeholder="Cari berdasarkan posisi atau keahlian..."
                                        class="w-full rounded-xl border border-zinc-300 bg-white/80 pl-9 pr-3 py-2.5 text-xs text-zinc-900 placeholder-zinc-500 transition-colors duration-200 focus:border-[#1ca093] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-600 dark:bg-zinc-800/80 dark:text-zinc-100 dark:placeholder-zinc-400 dark:focus:bg-zinc-800" />

                                </div>

                                <!-- Search button -->
                                <div class="sm:col-span-3">
                                    <button type="button"
                                        class="w-full inline-flex items-center justify-center font-semibold text-xs px-4 py-2.5 rounded-xl gap-1.5 bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] shadow-md shadow-[#1ca093]/30 cursor-pointer transition-all active:scale-95 min-h-[40px]">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                        <span>Cari</span>
                                    </button>
                                </div>
                            </form>

                            <!-- Popular Tag Chips -->
                            <div
                                class="mt-2.5 pt-2 border-t border-zinc-200/60 dark:border-zinc-800 flex flex-wrap items-center gap-1.5 text-[11px] text-zinc-500 dark:text-zinc-400 px-1">
                                <span class="font-medium mr-1 text-zinc-700 dark:text-zinc-300">Contoh :</span>
                                <button @click="keyword = 'Operator-sewing'" type="button"
                                    class="px-2 py-0.5 rounded-md bg-white/60 hover:bg-white dark:bg-zinc-800 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 cursor-pointer transition-colors shadow-sm">Operator
                                    sewing</button>
                                <button @click="keyword = 'Staff'" type="button"
                                    class="px-2 py-0.5 rounded-md bg-white/60 hover:bg-white dark:bg-zinc-800 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 cursor-pointer transition-colors shadow-sm">Staff</button>
                                <button @click="keyword = 'Admin'" type="button"
                                    class="px-2 py-0.5 rounded-md bg-white/60 hover:bg-white dark:bg-zinc-800 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 cursor-pointer transition-colors shadow-sm">Admin</button>
                                <button @click="keyword = 'Manager'" type="button"
                                    class="px-2 py-0.5 rounded-md bg-white/60 hover:bg-white dark:bg-zinc-800 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 cursor-pointer transition-colors shadow-sm">Manager</button>

                                <template x-if="keyword || location">
                                    <button @click="resetFilters()" type="button"
                                        class="ml-auto text-[#1ca093] dark:text-[#2dd4bf] font-semibold hover:underline cursor-pointer">
                                        Reset Pencarian
                                    </button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- KOLOM KANAN: Gambar Karakter 3D Tanpa Background -->
                    <div class="hidden lg:flex justify-center relative">
                        <!-- Efek glow di belakang gambar -->
                        {{-- <div
                            class="absolute inset-0 bg-gradient-to-tr from-[#1ca093]/20 to-[#2dd4bf]/20 blur-3xl rounded-full scale-75">
                        </div> --}}

                        <!-- Gambar Anda (Ganti src dengan path gambar asli Anda) -->
                        <img src="{{ asset('images/hero.png') }}" alt="Karakter Karier"
                            class="relative z-10 w-full max-w-md object-contain animate-float " />
                    </div>

                </div>
            </div>
        </section>

        <!-- ... LANJUTKAN DENGAN MAIN CAREER EXPLORER BODY (Sama seperti sebelumnya) ... -->

        <!-- MAIN CAREER EXPLORER BODY -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <div class="flex flex-col lg:flex-row items-start gap-8">

                <!-- DESKTOP FILTER SIDEBAR -->
                <aside class="hidden lg:block w-64 shrink-0 space-y-6 select-none">
                    <div
                        class="p-5 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs space-y-5">
                        <!-- Filter Header -->
                        <div class="flex items-center justify-between pb-3 border-b border-zinc-100 dark:border-zinc-800">
                            <h3
                                class="text-xs font-bold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-[#1ca093]"></span>
                                <span>Filter Lowongan</span>
                            </h3>
                            <button type="button" @click="resetFilters()"
                                class="text-[11px] text-[#1ca093] hover:underline dark:text-[#2dd4bf] cursor-pointer">
                                Reset
                            </button>
                        </div>

                        <!-- Category Filter -->
                        <div class="space-y-2">
                            <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                                Posisi
                            </label>
                            <div class="space-y-1.5 text-xs text-zinc-600 dark:text-zinc-400">
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="cat" value="all" x-model="selectedCategory"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Semua Posisi</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="cat" value="engineering" x-model="selectedCategory"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Staff</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="cat" value="design" x-model="selectedCategory"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Admin</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="cat" value="marketing" x-model="selectedCategory"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Operator</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="cat" value="data" x-model="selectedCategory"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Mekanik</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="cat" value="data" x-model="selectedCategory"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Other</span>
                                </label>
                            </div>
                        </div>

                        <!-- Workplace System -->
                        <div class="space-y-2 pt-3 border-t border-zinc-100 dark:border-zinc-800">
                            <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                                Sistem Kerja
                            </label>
                            <div class="space-y-1.5 text-xs text-zinc-600 dark:text-zinc-400">
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="wp" value="all" x-model="selectedWorkplace"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Semua Sistem</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="wp" value="onsite" x-model="selectedWorkplace"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Onsite</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="wp" value="remote" x-model="selectedWorkplace"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Remote</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="wp" value="hybrid" x-model="selectedWorkplace"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Hybrid</span>
                                </label>
                            </div>
                        </div>

                        <!-- Job Type -->
                        <div class="space-y-2 pt-3 border-t border-zinc-100 dark:border-zinc-800">
                            <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                                Tipe Kontrak
                            </label>
                            <div class="space-y-1.5 text-xs text-zinc-600 dark:text-zinc-400">
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="jt" value="all" x-model="selectedType"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Semua Tipe</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="jt" value="full-time" x-model="selectedType"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Full-Time</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="jt" value="contract" x-model="selectedType"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Kontrak Proyek</span>
                                </label>
                                <label
                                    class="flex items-center gap-2 cursor-pointer hover:text-zinc-900 dark:hover:text-zinc-100">
                                    <input type="radio" name="jt" value="internship" x-model="selectedType"
                                        class="h-3.5 w-3.5 text-[#1ca093] focus:ring-[#1ca093]/20 dark:bg-zinc-800 dark:border-zinc-700">
                                    <span>Magang (Internship)</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Verified Candidate Promo Widget -->
                    <div class="p-4 rounded-2xl border border-[#1ca093]/30 bg-[#e7f6f3]/60 dark:bg-[#1ca093]/10 text-xs">
                        <div class="font-bold text-[#168579] dark:text-[#2dd4bf] mb-1">Profil Kandidat Terverifikasi</div>
                        <p class="text-zinc-600 dark:text-zinc-400 text-[11px] leading-relaxed mb-3">
                            Lengkapi resume & portofolio Anda untuk dihubungi langsung oleh perusahaan rekanan.
                        </p>
                        <a href="{{ route('candidate.profile') }}"
                            class="block text-center py-1.5 px-3 rounded-lg bg-[#1ca093] text-white hover:bg-[#168579] text-xs font-semibold shadow-2xs transition-colors">
                            Buka Profil Saya
                        </a>
                    </div>
                </aside>

                <!-- JOB LISTINGS COLUMN -->
                <div class="flex-1 w-full min-w-0 space-y-4">

                    <!-- Toolbar Header & Mobile Filter Trigger -->
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-zinc-200/80 dark:border-zinc-800">
                        <div>
                            <h2 class="text-base font-bold text-zinc-900 dark:text-zinc-100">
                                Daftar Lowongan Pekerjaan
                            </h2>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                Menampilkan <span class="font-bold text-zinc-900 dark:text-zinc-100"
                                    x-text="filteredJobs().length"></span> lowongan aktif
                            </p>
                        </div>

                        <!-- Mobile Filter Drawer Trigger -->
                        <div class="lg:hidden">
                            <button type="button" @click="mobileFilterOpen = !mobileFilterOpen"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-xs font-semibold text-zinc-800 dark:text-zinc-200 shadow-2xs">
                                <svg class="w-3.5 h-3.5 text-[#1ca093]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                </svg>
                                <span x-text="mobileFilterOpen ? 'Tutup Filter' : 'Filter Lowongan'"></span>
                            </button>
                        </div>
                    </div>

                    <!-- Mobile Filter Panel (Collapsible) -->
                    <div x-show="mobileFilterOpen" x-transition
                        class="lg:hidden p-4 rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900 space-y-3"
                        style="display: none;">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                            <div>
                                <label class="block font-medium mb-1 text-zinc-700 dark:text-zinc-300">Bidang</label>
                                <select x-model="selectedCategory"
                                    class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 dark:[color-scheme:dark]">
                                    <option value="all">Semua Bidang</option>
                                    <option value="engineering">Software Engineering</option>
                                    <option value="design">Product Design</option>
                                    <option value="marketing">Marketing</option>
                                    <option value="data">Data & BI</option>
                                </select>
                            </div>
                            <div>
                                <label class="block font-medium mb-1 text-zinc-700 dark:text-zinc-300">Sistem Kerja</label>
                                <select x-model="selectedWorkplace"
                                    class="w-full rounded-lg border border-zinc-300 dark:border-zinc-700 p-2 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 dark:[color-scheme:dark]">
                                    <option value="all">Semua Sistem</option>
                                    <option value="remote">Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="onsite">Onsite</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- JOB CARDS LIST -->
                    <div class="space-y-3">
                        <template x-for="job in filteredJobs()" :key="job.id">
                            <div class="p-4 sm:p-5 rounded-2xl border transition-all duration-150 bg-white dark:bg-zinc-900 shadow-2xs hover:shadow-md hover:border-[#1ca093]/40 dark:hover:border-[#1ca093]/40"
                                :class="job.is_featured ? 'border-[#1ca093]/30 dark:border-[#1ca093]/30 ring-1 ring-[#1ca093]/15' : 'border-zinc-200/80 dark:border-zinc-800'">
                                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 sm:gap-4">
                                    <!-- Logo & Information -->
                                    <div class="flex items-start gap-3.5 flex-1 min-w-0">
                                        <div
                                            class="w-11 h-11 rounded-xl bg-gradient-to-br from-[#1ca093] to-[#137267] text-white flex items-center justify-center font-bold text-sm shrink-0 shadow-sm">
                                            <span x-text="job.logo_initials || 'PM'"></span>
                                        </div>

                                        <div class="min-w-0 flex-1 space-y-1">
                                            <!-- Title & Badges -->
                                            <div class="flex flex-wrap items-center gap-2">
                                                <a :href="'/careers/jobs/' + job.id"
                                                    class="text-sm sm:text-base font-bold text-zinc-900 dark:text-white hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors truncate"
                                                    x-text="job.title"></a>

                                                <!-- Badges dari Database JSON -->
                                                <template x-for="badge in (job.badges || [])" :key="badge">
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold tracking-wide"
                                                        :class="badge === 'New' ? 'bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/20 dark:text-[#2dd4bf]' : (badge === 'Urgent' ? 'bg-red-50 text-red-700 dark:bg-red-950 dark:text-red-300' : 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300')"
                                                        x-text="badge"></span>
                                                </template>
                                            </div>

                                            <!-- Company, Location & Salary -->
                                            <div
                                                class="flex flex-wrap items-center gap-x-2.5 gap-y-1 text-xs text-zinc-600 dark:text-zinc-400">
                                                <span class="font-semibold text-zinc-800 dark:text-zinc-200"
                                                    x-text="job.company"></span>
                                                <span>•</span>
                                                <span x-text="job.location"></span>
                                                <span>•</span>
                                                <span class="font-bold text-emerald-600 dark:text-emerald-400"
                                                    x-text="job.salary"></span>
                                            </div>

                                            <!-- Short 2-line Description -->
                                            <!-- Gunakan excerpt yang sudah kita buat di Model -->
                                            <p class="text-xs text-zinc-500 dark:text-zinc-400 line-clamp-2 pt-0.5 leading-relaxed"
                                                x-text="stripHtml(job.description)"></p>
                                        </div>
                                    </div>

                                    <!-- Bookmark Button -->
                                    <button type="button" @click="toggleBookmark(job.id)"
                                        class="p-2 rounded-xl border transition-colors cursor-pointer self-start shrink-0"
                                        :class="bookmarkedJobs.includes(job.id) ? 'border-[#1ca093]/40 bg-[#e7f6f3] text-[#1ca093] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] dark:border-[#1ca093]/40' : 'border-zinc-200 bg-white text-zinc-400 hover:text-zinc-700 dark:border-zinc-800 dark:bg-zinc-800 dark:hover:text-zinc-200'"
                                        :title="bookmarkedJobs.includes(job.id) ? 'Hapus bookmark' : 'Simpan lowongan'">
                                        <svg class="w-4 h-4"
                                            :class="bookmarkedJobs.includes(job.id) ? 'fill-current' : 'fill-none'"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Footer Meta & Actions -->
                                <div
                                    class="mt-3.5 pt-3 border-t border-zinc-100 dark:border-zinc-800/80 flex flex-wrap items-center justify-between gap-3 text-xs">
                                    <div class="flex items-center gap-2 text-zinc-400 text-[11px]">
                                        <span
                                            class="px-2 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300"
                                            x-text="job.workplace"></span>
                                        <span
                                            class="px-2 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-300"
                                            x-text="job.type"></span>
                                        <span>•</span>
                                        <span x-text="'Diposting ' + new Date(job.posted_at).toLocaleDateString()"></span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button type="button" @click="openDetailModal(job)"
                                            class="px-3 py-1.5 rounded-lg border border-zinc-300 dark:border-zinc-700 text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors cursor-pointer">
                                            Detail Ringkas
                                        </button>

                                        <!-- 👇 TOMBOL LAMAR DI CARD DIUBAH MENJADI BUTTON 👇 -->
                                        <button type="button" @click="applyJob(job.id)"
                                            class="inline-flex items-center gap-1 px-3.5 py-1.5 rounded-lg bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] text-xs font-semibold shadow-2xs transition-all active:scale-95">
                                            <span>Lamar</span>
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Empty State -->
                    <div x-show="filteredJobs().length === 0" style="display: none;">
                        <div
                            class="p-8 text-center rounded-2xl border border-dashed border-zinc-300 dark:border-zinc-700 bg-white dark:bg-zinc-900">
                            <p class="text-sm font-semibold text-zinc-900 dark:text-white">Tidak ada lowongan yang sesuai
                                kriteria</p>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Coba ubah kata kunci pencarian atau
                                bersihkan filter sistem kerja.</p>
                            <button type="button" @click="resetFilters()"
                                class="mt-3 px-4 py-2 rounded-lg bg-[#1ca093] text-white text-xs font-semibold hover:bg-[#168579] cursor-pointer">
                                Reset Seluruh Filter
                            </button>
                        </div>
                    </div>

                    <!-- Compact Pagination Footer -->
                    <div class="pt-6">
                        <x-ui.pagination :currentPage="1" :totalPages="1" :totalRecords="$jobs->count()" :perPage="20" />
                    </div>
                </div>
            </div>
        </div>

        <!-- MODERN JOB DETAIL MODAL -->
        <x-ui.modal name="job-detail-modal" maxWidth="2xl">
            <template x-if="selectedJob">
                <div class="space-y-4">
                    <!-- Modal Job Header -->
                    <div class="flex items-start gap-3.5 pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <div
                            class="w-12 h-12 rounded-xl bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] border border-[#1ca093]/20 dark:border-[#1ca093]/30 flex items-center justify-center font-bold text-base shrink-0">
                            <span x-text="selectedJob.logo_initials || 'LOGO'"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-bold text-zinc-900 dark:text-zinc-100" x-text="selectedJob.title">
                            </h3>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">
                                <span class="font-semibold text-zinc-800 dark:text-zinc-200"
                                    x-text="selectedJob.company"></span>
                                <span>•</span>
                                <span x-text="selectedJob.location"></span>
                            </p>
                            <div class="mt-2 flex flex-wrap gap-1.5 text-xs">
                                <span
                                    class="px-2 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-[11px]"
                                    x-text="selectedJob.type"></span>
                                <span
                                    class="px-2 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 text-[11px]"
                                    x-text="selectedJob.workplace"></span>
                                <span class="font-bold text-emerald-600 dark:text-emerald-400 text-xs ml-1"
                                    x-text="selectedJob.salary"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Description & Details (Scrollable max 60vh) -->
                    <div class="space-y-3.5 text-xs leading-relaxed max-h-[55vh] overflow-y-auto pr-1">
                        <div>
                            <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-1">Informasi lengkap</h4>
                            <div class="text-zinc-600 dark:text-zinc-400 text-xs leading-relaxed space-y-2"
                                x-html="selectedJob.description">
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-1">Tanggung Jawab Utama</h4>
                            <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-400 space-y-1">
                                <template x-for="(resp, i) in (selectedJob.responsibilities || [])" :key="i">
                                    <li x-text="resp"></li>
                                </template>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-1">Kualifikasi</h4>
                            <ul class="list-disc list-inside text-zinc-600 dark:text-zinc-400 space-y-1">
                                <template x-for="(qual, i) in (selectedJob.qualifications || [])" :key="i">
                                    <li x-text="qual"></li>
                                </template>
                            </ul>
                        </div>

                        <div
                            class="p-3 rounded-xl bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-200/60 dark:border-zinc-800">
                            <h4 class="font-semibold text-zinc-900 dark:text-zinc-100 mb-0.5">Tentang Perusahaan</h4>
                            <p class="text-zinc-600 dark:text-zinc-400 text-[11px]" x-text="selectedJob.company_info"></p>
                        </div>
                    </div>
                </div>
            </template>

            <x-slot:footer>
                <div class="flex items-center justify-between w-full">
                    <!-- Bookmark button inside modal -->
                    <button type="button" @click="if(selectedJob) toggleBookmark(selectedJob.id)"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-zinc-300 dark:border-zinc-700 text-xs text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer">
                        <svg class="w-4 h-4 text-amber-500 fill-current" viewBox="0 0 24 24">
                            <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <span
                            x-text="selectedJob && bookmarkedJobs.includes(selectedJob.id) ? 'Tersimpan' : 'Simpan'"></span>
                    </button>

                    <div class="flex items-center gap-2">
                        <button type="button" @click="$dispatch('close-modal', 'job-detail-modal')"
                            class="px-3.5 py-2 text-xs font-medium border border-zinc-300 dark:border-zinc-700 rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer">
                            Tutup
                        </button>

                        <!-- 👇 TOMBOL LAMAR DI MODAL DIUBAH MENJADI BUTTON 👇 -->
                        <button type="button" @click="applyJob(selectedJob.id)"
                            class="inline-flex items-center justify-center font-semibold text-xs px-4 py-2 rounded-lg gap-1.5 bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] shadow-xs cursor-pointer">
                            <span>Lamar Sekarang</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </x-slot:footer>
        </x-ui.modal>
    </div>

    <!-- PINDAHKAN LOGIKA ALPINE KE SINI (Agar rapi dan tidak diacak IDE) -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('careerPortal', () => ({
                keyword: '',
                location: '',
                selectedCategory: 'all',
                selectedType: 'all',
                selectedWorkplace: 'all',
                mobileFilterOpen: false,
                bookmarkedJobs: [],
                selectedJob: null,
                jobs: @js($jobs),

                toggleBookmark(id) {
                    if (this.bookmarkedJobs.includes(id)) {
                        this.bookmarkedJobs = this.bookmarkedJobs.filter(item => item !== id);
                        this.$store.toasts.add({title: 'Lowongan Dihapus', message: 'Lowongan telah dihapus dari bookmark.', type: 'info'});
                    } else {
                        this.bookmarkedJobs.push(id);
                        this.$store.toasts.add({title: 'Lowongan Tersimpan', message: 'Lowongan berhasil disimpan ke bookmark Anda.', type: 'success'});
                    }
                },
                filteredJobs() {
                    return this.jobs.filter(j => {
                        const matchKeyword = !this.keyword ||
                            j.title.toLowerCase().includes(this.keyword.toLowerCase()) ||
                            (j.company && j.company.toLowerCase().includes(this.keyword.toLowerCase()));

                        const matchLocation = !this.location ||
                            (j.location && j.location.toLowerCase().includes(this.location.toLowerCase()));

                        const matchCategory = this.selectedCategory === 'all' || j.category === this.selectedCategory;
                        const matchType = this.selectedType === 'all' || (j.type && j.type.toLowerCase() === this.selectedType.toLowerCase());
                        const matchWorkplace = this.selectedWorkplace === 'all' || (j.workplace && j.workplace.toLowerCase() === this.selectedWorkplace.toLowerCase());

                        return matchKeyword && matchLocation && matchCategory && matchType && matchWorkplace;
                    });
                },
                resetFilters() {
                    this.keyword = '';
                    this.location = '';
                    this.selectedCategory = 'all';
                    this.selectedType = 'all';
                    this.selectedWorkplace = 'all';
                },
                openDetailModal(job) {
                    this.selectedJob = job;
                    this.$dispatch('open-modal', 'job-detail-modal');
                },
                stripHtml(html) {
                    if (!html) return '';
                    let tmp = document.createElement("DIV");
                    tmp.innerHTML = html;
                    return tmp.textContent || tmp.innerText || "";
                },

                // 👇 FUNGSI AJAX UNTUK MELAMAR 👇
                async applyJob(jobId) {
                    this.$store.toasts.add({title: 'Memproses', message: 'Mengirim lamaran Anda...', type: 'info'});

                    try {
                        const response = await fetch(`/careers/jobs/${jobId}/apply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.$store.toasts.add({title: 'Berhasil!', message: data.message, type: 'success'});
                            this.$dispatch('close-modal', 'job-detail-modal');
                        } else {
                            this.$store.toasts.add({title: 'Gagal Melamar', message: data.error, type: 'error'});
                        }
                    } catch (error) {
                        this.$store.toasts.add({title: 'Error', message: 'Terjadi kesalahan jaringan.', type: 'error'});
                    }
                }
            }));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            await tsParticles.load("tsparticles", {
                fullScreen: {enable: false},
                fpsLimit: 60,
                particles: {
                    number: {value: 70, density: {enable: true, value_area: 800}},
                    color: {value: ["#1ca093", "#2dd4bf", "#e7f6f3"]},
                    shape: {type: "circle"},
                    opacity: {value: 0.3, random: true},
                    size: {value: {min: 1, max: 4}, random: true},
                    links: {enable: true, distance: 150, color: "#1ca093", opacity: 0.2, width: 1},
                    move: {enable: true, speed: 1, direction: "none", random: true, straight: false, outModes: {default: "bounce"}}
                },
                interactivity: {
                    events: {onHover: {enable: true, mode: "grab"}, onClick: {enable: true, mode: "push"}},
                    modes: {grab: {distance: 140, links: {opacity: 0.5}}, push: {quantity: 3}}
                },
                detectRetina: true
            });
        });
    </script>
@endsection