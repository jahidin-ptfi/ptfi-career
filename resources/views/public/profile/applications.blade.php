@extends('layouts.public', ['title' => 'Lamaran Saya — ' . ($user->profile?->nama ?? $user->username)])

@section('content')
    {{-- 👇 LOGIKA PENGHITUNG KELENGKAPAN PROFIL SECARA DINAMIS 👇 --}}
    @php
        $isFilled = function ($value) {
            return !is_null($value) && $value !== '';
        };

        // 1. Cek Data Dasar & Kontak (15 Field)
        $basicFields = [
            $user->email,
            $user->profile?->nama,
            $user->profile?->no_ktp,
            $user->profile?->jenis_kelamin,
            $user->profile?->tempat_lahir,
            $user->profile?->tgl_lahir,
            $user->profile?->agama,
            $user->profile?->status_pernikahan,
            $user->profile?->gol_darah,
            $user->profile?->alamat,
            $user->profile?->provinsi_id,
            $user->profile?->kota_id,
            $user->profile?->kecamatan_id,
            $user->profile?->kelurahan_id,
            $user->profile?->selular,
        ];

        // 2. Cek Relasi (7 Poin)
        $relations = [
            $user->educations->count() > 0,
            $user->experiences->count() > 0,
            $user->skills->count() > 0,
            $user->courses->count() > 0,
            $user->documents->count() > 0,
            $user->emergencyContacts->count() > 0,
            $user->families->count() > 0,
        ];

        $totalPoints = count($basicFields) + count($relations); // Total 22 Poin
        $earnedPoints = 0;

        // Hitung field yang terisi
        foreach ($basicFields as $val) {
            if ($isFilled($val))
                $earnedPoints++;
        }

        // Hitung relasi yang ada datanya
        foreach ($relations as $hasData) {
            if ($hasData)
                $earnedPoints++;
        }

        $percentage = round(($earnedPoints / $totalPoints) * 100);

        // Tentukan Warna Progress Bar
        if ($percentage >= 90) {
            $progressColor = 'bg-emerald-500';
            $progressTextColor = 'text-emerald-500';
            $progressMsg = 'Profil Anda sudah sangat lengkap!';
        } elseif ($percentage >= 60) {
            $progressColor = 'bg-[#1ca093]';
            $progressTextColor = 'text-[#1ca093]';
            $progressMsg = 'Lengkapi dokumen & relasi lainnya.';
        } elseif ($percentage >= 30) {
            $progressColor = 'bg-amber-500';
            $progressTextColor = 'text-amber-500';
            $progressMsg = 'Profil Anda belum maksimal.';
        } else {
            $progressColor = 'bg-red-500';
            $progressTextColor = 'text-red-500';
            $progressMsg = 'Ayo lengkapi profil Anda!';
        }
    @endphp

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">

        <!-- Candidate Profile Header -->
        <div
            class="p-5 sm:p-8 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm mb-6 sm:mb-8 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#1ca093]/10 to-transparent rounded-bl-full pointer-events-none">
            </div>

            <div
                class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-zinc-100 dark:border-zinc-800">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                    <div class="relative shrink-0">
                        @if($user->profile?->foto)
                            <img src="{{ asset('storage/uploads/' . $user->profile->foto) }}" alt="Foto Profil"
                                class="w-20 h-20 rounded-2xl object-cover border-2 border-white dark:border-zinc-800 shadow-sm">
                        @else
                            <div
                                class="w-20 h-20 rounded-2xl bg-gradient-to-br from-[#e7f6f3] to-[#c4eae3] text-[#168579] dark:from-[#1ca093]/20 dark:to-[#1ca093]/5 dark:text-[#2dd4bf] font-bold text-2xl flex items-center justify-center border-2 border-white dark:border-zinc-800 shadow-sm uppercase">
                                {{ substr($user->profile?->nama ?? $user->username, 0, 2) }}
                            </div>
                        @endif
                        <span
                            class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-emerald-500 ring-2 ring-white dark:ring-zinc-900"
                            title="Status Akun"></span>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                                {{ $user->profile?->nama ?? $user->username }}
                            </h1>
                            <x-ui.badge variant="success" dot="true">Kandidat</x-ui.badge>
                        </div>
                        <p class="mt-1 text-xs sm:text-sm font-medium text-zinc-700 dark:text-zinc-300">@
                            {{ $user->username }}
                        </p>

                        <!-- Kontak & Kota -->
                        <div
                            class="mt-2.5 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $user->email ?? 'Email belum diisi' }}</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span>{{ $user->profile?->selular ?? 'No HP belum diisi' }}</span>
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-zinc-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $user->profile?->kota_nama ?? 'Kota' }},
                                    {{ $user->profile?->provinsi_nama ?? 'Provinsi' }}</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action & Progress Bar -->
                <div
                    class="flex flex-col sm:flex-row lg:flex-col items-start lg:items-end gap-3 self-start lg:self-center shrink-0 w-full sm:w-auto">
                    <a href="{{ route('candidate.profile') }}"
                        class="min-h-[44px] inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-xs font-semibold text-zinc-800 dark:text-zinc-200 transition-colors shadow-sm">
                        <svg class="w-4 h-4 text-[#1ca093] dark:text-[#2dd4bf]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Lihat Profil Saya</span>
                    </a>

                    <!-- Progress Bar Kelengkapan Dinamis -->
                    <div
                        class="w-full sm:w-64 bg-zinc-50 dark:bg-zinc-800/50 p-3 rounded-xl border border-zinc-100 dark:border-zinc-800">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-[11px] font-semibold text-zinc-600 dark:text-zinc-400">Kelengkapan
                                Profil</span>
                            <span class="text-[11px] font-bold {{ $progressTextColor }}">{{ $percentage }}%</span>
                        </div>
                        <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-1.5">
                            <div class="{{ $progressColor }} h-1.5 rounded-full transition-all duration-500"
                                style="width: {{ $percentage }}%"></div>
                        </div>
                        <p
                            class="text-[10px] {{ $percentage == 100 ? 'text-emerald-500' : 'text-zinc-500' }} mt-1.5 text-right font-medium">
                            {{ $progressMsg }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Lamaran -->
        <div class="p-5 sm:p-8 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm">
            <div class="flex items-center justify-between pb-4 mb-6 border-b border-zinc-100 dark:border-zinc-800">
                <h2 class="text-lg font-bold text-zinc-900 dark:text-white">Riwayat Lamaran</h2>
                <span class="text-xs font-semibold text-zinc-500 bg-zinc-100 dark:bg-zinc-800 px-3 py-1 rounded-lg">Total: {{ $applications->count() }}</span>
            </div>

            <div class="space-y-4">
                @forelse($applications as $app)
                    @php
                        // Konfigurasi Status Lamaran (Warna & Teks)
                        $statusConfig = match($app->status) {
                            'applied' => [
                                'bg' => 'bg-blue-50 dark:bg-blue-500/10',
                                'text' => 'text-blue-700 dark:text-blue-400',
                                'border' => 'border-blue-200 dark:border-blue-500/20',
                                'dot' => 'bg-blue-500',
                                'label' => 'Applied'
                            ],
                            'interview' => [
                                'bg' => 'bg-amber-50 dark:bg-amber-500/10',
                                'text' => 'text-amber-700 dark:text-amber-400',
                                'border' => 'border-amber-200 dark:border-amber-500/20',
                                'dot' => 'bg-amber-500',
                                'label' => 'Interview'
                            ],
                            'diterima' => [
                                'bg' => 'bg-emerald-50 dark:bg-emerald-500/10',
                                'text' => 'text-emerald-700 dark:text-emerald-400',
                                'border' => 'border-emerald-200 dark:border-emerald-500/20',
                                'dot' => 'bg-emerald-500',
                                'label' => 'Diterima'
                            ],
                            'ditolak' => [
                                'bg' => 'bg-red-50 dark:bg-red-500/10',
                                'text' => 'text-red-700 dark:text-red-400',
                                'border' => 'border-red-200 dark:border-red-500/20',
                                'dot' => 'bg-red-500',
                                'label' => 'Ditolak'
                            ],
                            default => [
                                'bg' => 'bg-zinc-50 dark:bg-zinc-800',
                                'text' => 'text-zinc-700 dark:text-zinc-300',
                                'border' => 'border-zinc-200 dark:border-zinc-700',
                                'dot' => 'bg-zinc-500',
                                'label' => ucfirst($app->status)
                            ],
                        };
                    @endphp



                    <div class="group relative p-4 sm:p-5 rounded-2xl border border-[#1ca093]/40 bg-white dark:border-[#1ca093]/40 dark:bg-zinc-800/40 shadow-sm hover:shadow-md hover:border-[#1ca093]/40 dark:hover:border-[#1ca093]/40 transition-all flex flex-col sm:flex-row sm:items-center justify-between gap-4 overflow-hidden">

                        <!-- Garis Aksen Kiri (Muncul saat Hover) -->
                       <div class="absolute inset-y-0 left-0 w-1 bg-transparent group-hover:bg-[#1ca093] transition-colors rounded-l-2xl"></div>

                        <!-- Kiri: Info Lowongan -->
                        <div class="flex items-start gap-4">
                            <!-- Avatar Inisial Perusahaan -->
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center text-zinc-600 dark:text-zinc-300 font-bold text-lg shrink-0 border border-zinc-200/50 dark:border-zinc-700 shadow-sm">
                                {{ substr($app->jobListing->company ?? 'PT', 0, 2) }}
                            </div>

                            <div class="min-w-0">
                                <h3 class="font-bold text-[#2dd4bf] dark:text-[#2dd4bf] text-base truncate group-hover:text-[#1ca093] dark:group-hover:text-[#2dd4bf] transition-colors">
                                    {{ $app->jobListing->title ?? 'Lowongan Telah Dihapus' }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-2 mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                                    <span class="font-medium">{{ $app->jobListing->company ?? '-' }}</span>
                                    <span>•</span>
                                    <span>{{ $app->jobListing->location ?? '-' }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 mt-2 text-[11px] text-zinc-400">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    <span>Dilamar: {{ \Carbon\Carbon::parse($app->applied_at)->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Kanan: Status & Tombol -->
                        <div class="flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center gap-3 shrink-0 pt-3 sm:pt-0 border-t sm:border-0 border-zinc-100 dark:border-zinc-800">

                            <!-- Badge Status (Dark/Light Kompatibel) -->
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[11px] font-bold border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $statusConfig['dot'] }} animate-pulse"></span>
                                {{ $statusConfig['label'] }}
                            </span>

                            <!-- Tombol Lihat Detail -->
                            @if($app->jobListing)
                                <a href="{{ route('jobs.show', $app->jobListing->id) }}"
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-xs font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors shadow-2xs">
                                    <span>Detail</span>
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                                </a>
                            @else
                                <span class="text-[10px] text-zinc-400 italic">Lowongan Ditarik</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center p-10 border border-dashed border-zinc-300 dark:border-zinc-700 rounded-2xl">
                        <svg class="w-12 h-12 mx-auto text-zinc-300 dark:text-zinc-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">Belum Ada Lamaran</p>
                        <p class="text-xs text-zinc-500 mt-1">Anda belum pernah melamar pekerjaan. Silakan cari lowongan yang cocok.</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-[#1ca093] text-white text-xs font-semibold rounded-lg hover:bg-[#168579] transition-colors">
                            Cari Lowongan
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
