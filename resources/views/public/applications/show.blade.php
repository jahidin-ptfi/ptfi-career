@extends('layouts.public', ['title' => 'Detail Lamaran: Senior Laravel & Cloud Architect — Budi Pratama'])

@section('content')
<div 
    x-data="{
        cancelModalOpen: false,
        withdrawConfirmed: false,
        showCoverLetter: false,
        copiedLink: false,
        copyMeetingLink() {
            navigator.clipboard?.writeText('https://meet.google.com/fsi-tech-iview');
            this.copiedLink = true;
            setTimeout(() => this.copiedLink = false, 2000);
        }
    }"
    class="py-6 sm:py-10 bg-zinc-50/50 dark:bg-zinc-950/50 min-h-screen"
>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb Navigation --}}
        <div class="overflow-x-auto pb-1 mb-6 -mx-4 px-4 sm:mx-0 sm:px-0">
            <nav class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400 whitespace-nowrap" aria-label="Breadcrumb">
                <a href="/" class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Beranda</a>
                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="/profile/applications" class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Lamaran Saya</a>
                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-zinc-900 dark:text-zinc-100 font-medium truncate">#APP-101 Senior Laravel & Cloud Architect</span>
            </nav>
        </div>

        {{-- Withdrawal Banner if Confirmed --}}
        <template x-if="withdrawConfirmed">
            <div class="mb-6 p-4 rounded-xl border border-amber-200 bg-amber-50 dark:border-amber-900/60 dark:bg-amber-950/40 text-amber-900 dark:text-amber-200 flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div class="text-xs">
                    <div class="font-semibold text-sm">Permintaan Pembatalan Telah Dikirim</div>
                    <p class="mt-0.5">Lamaran Anda untuk posisi ini telah ditandai ditarik oleh kandidat. Tim rekrutmen PT Fintek Sinergi Indonesia telah menerima notifikasi.</p>
                </div>
            </div>
        </template>

        {{-- Application Header Card --}}
        <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900 mb-6 sm:mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-5">
                <div class="flex items-start sm:items-center gap-4">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-[#e7f6f3] text-[#1ca093] dark:bg-[#1ca093]/20 dark:text-[#2dd4bf] font-bold text-xl flex items-center justify-center shrink-0 border border-[#1ca093]/25">
                        FS
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <span class="text-xs font-mono font-medium text-zinc-500 dark:text-zinc-400">#APP-101</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-[#e7f6f3] text-[#168579] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] border border-[#1ca093]/25">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#1ca093] mr-1.5 animate-pulse"></span>
                                Wawancara Tahap 2 (User & Tech Lead)
                            </span>
                        </div>
                        <h1 class="text-lg sm:text-2xl font-bold text-zinc-900 dark:text-white">
                            Senior Laravel & Cloud Architect
                        </h1>
                        <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 mt-0.5 flex flex-wrap items-center gap-x-2 gap-y-1">
                            <span class="font-medium text-zinc-800 dark:text-zinc-200">PT Fintek Sinergi Indonesia</span>
                            <span>•</span>
                            <span>Jakarta Selatan (Hybrid)</span>
                            <span>•</span>
                            <span>18 Oktober 2026</span>
                        </p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="flex items-center gap-2 shrink-0 self-start md:self-auto">
                    <a
                        href="/profile/applications"
                        class="min-h-[44px] inline-flex items-center justify-center font-medium transition-all text-xs px-3.5 py-2 rounded-xl gap-1.5 bg-white text-zinc-700 border border-zinc-300 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 dark:hover:bg-zinc-750"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        <span>Daftar Lamaran</span>
                    </a>

                    <template x-if="!withdrawConfirmed">
                        <button
                            @click="cancelModalOpen = true"
                            type="button"
                            class="min-h-[44px] inline-flex items-center justify-center font-medium transition-all text-xs px-3.5 py-2 rounded-xl gap-1.5 bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 dark:bg-red-950/40 dark:text-red-300 dark:border-red-900/60 dark:hover:bg-red-900/60 cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>Batalkan Lamaran</span>
                        </button>
                    </template>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            {{-- Left 2 Columns: Application Timeline & Details --}}
            <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                
                {{-- 5-Step Application Process Timeline --}}
                <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900">
                    <div class="flex items-center justify-between pb-4 border-b border-zinc-200 dark:border-zinc-800 mb-6">
                        <div>
                            <h2 class="text-base font-semibold text-zinc-900 dark:text-white">Alur & Status Seleksi</h2>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Pemantauan langkah seleksi rekrutmen secara transparan.</p>
                        </div>
                        <span class="text-xs font-semibold text-[#168579] dark:text-[#2dd4bf] bg-[#e7f6f3] dark:bg-[#1ca093]/15 px-2.5 py-1 rounded-lg border border-[#1ca093]/25">
                            Tahap 4 dari 5
                        </span>
                    </div>

                    {{-- Timeline List --}}
                    <div class="relative pl-6 space-y-7 before:absolute before:left-2.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-zinc-200 dark:before:bg-zinc-800">
                        
                        {{-- Step 1: Completed --}}
                        <div class="relative">
                            <span class="absolute -left-6 top-0.5 flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500 text-white ring-4 ring-white dark:ring-zinc-900">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">1. Lamaran Berhasil Dikirim</h3>
                                <span class="text-xs text-zinc-400 font-mono">18 Okt 2026, 09:30 WIB</span>
                            </div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                Berkas CV dan dokumen pengantar telah diterima sistem rekrutmen.
                            </p>
                        </div>

                        {{-- Step 2: Completed --}}
                        <div class="relative">
                            <span class="absolute -left-6 top-0.5 flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500 text-white ring-4 ring-white dark:ring-zinc-900">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">2. Peninjauan Berkas & Profil</h3>
                                <span class="text-xs text-zinc-400 font-mono">20 Okt 2026, 14:15 WIB</span>
                            </div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                Tim Talent Acquisition menyelesaikan verifikasi rekam jejak profesional.
                            </p>
                        </div>

                        {{-- Step 3: Completed --}}
                        <div class="relative">
                            <span class="absolute -left-6 top-0.5 flex items-center justify-center w-5 h-5 rounded-full bg-emerald-500 text-white ring-4 ring-white dark:ring-zinc-900">
                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">3. Seleksi Uji Teknis & Arsitektur</h3>
                                <span class="text-xs text-emerald-600 dark:text-emerald-400 font-medium">Lolos Evaluasi (Skor 94/100)</span>
                            </div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                Penilaian studi kasus perancangan payment gateway dinyatakan memuaskan.
                            </p>
                        </div>

                        {{-- Step 4: Active (Brand Teal #1ca093) --}}
                        <div class="relative">
                            <span class="absolute -left-6 top-0.5 flex items-center justify-center w-5 h-5 rounded-full bg-[#1ca093] text-white ring-4 ring-[#1ca093]/20 animate-pulse">
                                <span class="w-2 h-2 rounded-full bg-white"></span>
                            </span>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h3 class="text-sm font-bold text-[#1ca093] dark:text-[#2dd4bf]">4. Wawancara HR & Engineering Lead (Aktif)</h3>
                                <span class="text-xs text-[#168579] dark:text-[#2dd4bf] font-medium bg-[#e7f6f3] dark:bg-[#1ca093]/15 px-2 py-0.5 rounded-md border border-[#1ca093]/25">
                                    Rabu, 28 Okt 2026
                                </span>
                            </div>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-1">
                                Diskusi mendalam mengenai leadership tim, kultur kolaborasi, dan eksplorasi keselarasan teknis.
                            </p>

                            {{-- Interview Schedule Sub-Card --}}
                            <div class="mt-3 p-4 rounded-xl border border-[#1ca093]/30 bg-[#e7f6f3]/60 dark:border-[#1ca093]/30 dark:bg-[#1ca093]/10 text-zinc-800 dark:text-zinc-200">
                                <div class="flex items-center gap-2 text-xs font-semibold text-[#168579] dark:text-[#2dd4bf] mb-2">
                                    <svg class="w-4 h-4 text-[#1ca093] dark:text-[#2dd4bf]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>Jadwal Wawancara Terkonfirmasi</span>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs mb-3">
                                    <div>
                                        <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Waktu:</span>
                                        <span class="font-medium text-zinc-900 dark:text-zinc-100">Rabu, 28 Okt 2026 • 14:00 - 15:00 WIB</span>
                                    </div>
                                    <div>
                                        <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Pewawancara:</span>
                                        <span class="font-medium text-zinc-900 dark:text-zinc-100">Ahmad Fauzi & Maya K.</span>
                                    </div>
                                    <div>
                                        <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Platform:</span>
                                        <span class="font-medium text-zinc-900 dark:text-zinc-100">Google Meet (Online)</span>
                                    </div>
                                    <div>
                                        <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Tautan Sesi:</span>
                                        <span class="font-mono text-[#1ca093] dark:text-[#2dd4bf] truncate block">meet.google.com/fsi-tech-iview</span>
                                    </div>
                                </div>

                                <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-[#1ca093]/20 dark:border-[#1ca093]/20">
                                    <a
                                        href="https://meet.google.com"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="min-h-[40px] inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg text-xs font-semibold bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] shadow-xs transition-colors"
                                    >
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span>Buka Ruang Rapat</span>
                                    </a>

                                    <button
                                        @click="copyMeetingLink()"
                                        type="button"
                                        class="min-h-[40px] inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-white text-zinc-700 border border-zinc-300 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 transition-colors cursor-pointer"
                                    >
                                        <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span x-text="copiedLink ? 'Tautan Disalin!' : 'Salin Tautan'">Salin Tautan</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Step 5: Upcoming --}}
                        <div class="relative opacity-60">
                            <span class="absolute -left-6 top-0.5 flex items-center justify-center w-5 h-5 rounded-full bg-zinc-200 dark:bg-zinc-800 text-zinc-500 ring-4 ring-white dark:ring-zinc-900 text-xs">
                                5
                            </span>
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300">5. Keputusan Akhir & Penawaran (Offering)</h3>
                                <span class="text-xs text-zinc-400">Menunggu Tahap 4</span>
                            </div>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                                Surat penawaran kerja resmi (Offering Letter) beserta paket kompensasi.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Submitted Application Data & Attachments --}}
                <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900">
                    <h2 class="text-base font-semibold text-zinc-900 dark:text-white mb-4">Berkas & Informasi Terkirim</h2>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4 text-xs mb-5">
                        <div class="p-3.5 rounded-xl border border-zinc-200/70 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-850">
                            <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Ekspektasi Gaji Bersih:</span>
                            <span class="font-semibold text-sm text-zinc-900 dark:text-zinc-100 mt-0.5 block">Rp 35.000.000 / bulan</span>
                        </div>
                        <div class="p-3.5 rounded-xl border border-zinc-200/70 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-850">
                            <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Notice Period:</span>
                            <span class="font-semibold text-sm text-zinc-900 dark:text-zinc-100 mt-0.5 block">1 Bulan (30 Hari)</span>
                        </div>
                    </div>

                    {{-- Resume Attachment Item --}}
                    <div class="mb-4 p-3.5 sm:p-4 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-850 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-lg bg-red-100 text-red-600 dark:bg-red-950/60 dark:text-red-400 flex items-center justify-center shrink-0 font-bold text-xs uppercase tracking-wider">
                                PDF
                            </div>
                            <div class="min-w-0">
                                <div class="text-xs font-semibold text-zinc-900 dark:text-zinc-100 truncate">
                                    CV_Budi_Pratama_Senior_Architect_2026.pdf
                                </div>
                                <div class="text-[11px] text-zinc-500 dark:text-zinc-400">
                                    2.4 MB • Diperbarui Oktober 2026
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 shrink-0">
                            <a
                                href="#"
                                class="min-h-[40px] min-w-[40px] flex items-center justify-center rounded-lg text-zinc-600 hover:text-[#1ca093] hover:bg-zinc-100 dark:text-zinc-400 dark:hover:text-[#2dd4bf] dark:hover:bg-zinc-800 transition-colors"
                                title="Unduh Resume"
                            >
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    {{-- Cover Letter Excerpt --}}
                    <div class="p-4 rounded-xl border border-zinc-200/70 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-850">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">Surat Pengantar (Cover Letter)</span>
                            <button
                                @click="showCoverLetter = !showCoverLetter"
                                type="button"
                                class="text-xs text-[#1ca093] dark:text-[#2dd4bf] hover:underline cursor-pointer font-medium"
                                x-text="showCoverLetter ? 'Perkecil' : 'Baca Lengkap'"
                            >
                                Baca Lengkap
                            </button>
                        </div>
                        <p 
                            class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed"
                            :class="showCoverLetter ? '' : 'line-clamp-3'"
                        >
                            Dengan hormat Tim Rekrutmen PT Fintek Sinergi Indonesia, saya menuliskan lamaran ini dengan ketertarikan tinggi untuk posisi Senior Laravel & Cloud Architect. Berbekal pengalaman lebih dari 6 tahun memimpin perancangan sistem backend monolitik maupun microservices berskala jutaan request harian di industri fintech, saya yakin dapat menghadirkan arsitektur kode yang tangguh, clean, dan mematuhi kepatuhan keamanan finansial tinggi...
                        </p>
                    </div>
                </div>

            </div>

            {{-- Right Column: Vacancy Summary & Contact Help --}}
            <div class="space-y-6">
                
                {{-- Job Vacancy Overview --}}
                <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-white mb-4">Ringkasan Lowongan</h2>
                    
                    <div class="space-y-3 text-xs">
                        <div>
                            <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Posisi:</span>
                            <span class="font-semibold text-zinc-900 dark:text-zinc-100">Senior Laravel & Cloud Architect</span>
                        </div>
                        <div>
                            <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Perusahaan:</span>
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">PT Fintek Sinergi Indonesia</span>
                        </div>
                        <div>
                            <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Tipe:</span>
                            <span class="font-medium text-zinc-900 dark:text-zinc-100">Full-time (Hybrid)</span>
                        </div>
                        <div>
                            <span class="text-zinc-500 dark:text-zinc-400 block text-[11px]">Rentang Gaji:</span>
                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">Rp 28jt - 42jt / bln</span>
                        </div>
                    </div>

                    <div class="mt-5 pt-4 border-t border-zinc-200 dark:border-zinc-800">
                        <a
                            href="/careers/jobs/senior-laravel-cloud-architect"
                            class="w-full min-h-[44px] inline-flex items-center justify-center font-semibold transition-all text-xs px-3.5 py-2 rounded-xl gap-1.5 bg-[#e7f6f3] text-[#168579] hover:bg-[#1ca093]/20 dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] dark:hover:bg-[#1ca093]/25 border border-[#1ca093]/25"
                        >
                            <span>Lihat Detail Lowongan Penuh</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- HR Contact / Assistance Box --}}
                <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-zinc-50/70 dark:border-zinc-800 dark:bg-zinc-900/60">
                    <h3 class="text-xs font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-2">Bantuan & Koordinasi Rekrutmen</h3>
                    <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed mb-4">
                        Memerlukan perubahan jadwal interview atau info tambahan terkait tahapan seleksi?
                    </p>
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center gap-2 text-zinc-700 dark:text-zinc-300">
                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-mono text-[11px]">careers@finteksinergi.id</span>
                        </div>
                        <div class="flex items-center gap-2 text-zinc-700 dark:text-zinc-300">
                            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            <span class="font-mono text-[11px]">+62 21 5088 9200</span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- Cancel / Withdraw Modal --}}
    <x-ui.modal
        id="cancel-application-modal"
        title="Konfirmasi Pembatalan Lamaran"
        maxWidth="md"
        wire:model="cancelModalOpen"
    >
        <div class="space-y-4">
            <div class="p-3.5 rounded-xl border border-red-200 bg-red-50 dark:border-red-900/60 dark:bg-red-950/40 text-red-800 dark:text-red-200 text-xs">
                <span class="font-semibold block mb-1">Perhatian: Tindakan Tidak Dapat Dibatalkan</span>
                Jika Anda membatalkan lamaran untuk posisi <strong class="text-zinc-900 dark:text-white">Senior Laravel & Cloud Architect</strong>, Anda tidak dapat melamar kembali pada lowongan yang sama selama 90 hari kalender.
            </div>

            <div>
                <label class="block text-xs font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                    Alasan Pembatalan (Opsional):
                </label>
                <select class="w-full text-xs rounded-xl border border-zinc-300 bg-white px-3 py-2.5 text-zinc-900 focus:border-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 focus:outline-none dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 dark:[color-scheme:dark]">
                    <option value="">Pilih alasan pembatalan...</option>
                    <option value="accepted_elsewhere">Sudah menerima tawaran kerja di perusahaan lain</option>
                    <option value="schedule_conflict">Kendala jadwal wawancara tidak dapat disesuaikan</option>
                    <option value="location">Kendala lokasi kerja atau model hybrid</option>
                    <option value="salary">Ekspektasi kompensasi tidak selaras</option>
                    <option value="other">Alasan pribadi lainnya</option>
                </select>
            </div>
        </div>

        <x-slot:footer>
            <div class="flex items-center justify-end gap-2.5 w-full">
                <button
                    @click="cancelModalOpen = false"
                    type="button"
                    class="min-h-[40px] px-4 py-2 text-xs font-medium text-zinc-700 bg-white border border-zinc-300 rounded-xl hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 dark:hover:bg-zinc-750 cursor-pointer"
                >
                    Kembali
                </button>
                <button
                    @click="cancelModalOpen = false; withdrawConfirmed = true"
                    type="button"
                    class="min-h-[40px] px-4 py-2 text-xs font-semibold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-xs cursor-pointer"
                >
                    Ya, Batalkan Lamaran
                </button>
            </div>
        </x-slot:footer>
    </x-ui.modal>

</div>
@endsection
