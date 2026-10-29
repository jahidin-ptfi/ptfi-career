@extends('layouts.public', ['title' => 'Profil Kandidat — ' . ($user->profile?->nama ?? $user->username)])

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10" x-data="profileCrud()">

        <!-- Alert: Jika Profil Belum Lengkap -->
        @if(empty($user->profile?->nama))
            <div
                class="mb-6 p-4 rounded-xl border border-amber-200 bg-amber-50 text-amber-800 dark:border-amber-900/50 dark:bg-amber-950/30 dark:text-amber-400 text-sm flex items-start gap-3">
                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <span class="font-semibold block">Profil Anda Belum Lengkap!</span>
                    Silakan lengkapi data diri (Nama, Alamat, Kontak) agar Anda dapat melamar pekerjaan.
                </div>
            </div>
        @endif

        <!-- Candidate Profile Header -->
        <div
            class="p-5 sm:p-8 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm mb-6 sm:mb-8 relative overflow-hidden">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-[#1ca093]/10 to-transparent rounded-bl-full pointer-events-none">
            </div>

            <div
                class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-6 pb-6 border-b border-zinc-100 dark:border-zinc-800">
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
                        <div
                            class="mt-2.5 flex flex-wrap items-center gap-x-4 gap-y-1.5 text-xs text-zinc-500 dark:text-zinc-400">
                            <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-zinc-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg><span>{{ $user->email ?? 'Email belum diisi' }}</span></span>
                            <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-zinc-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg><span>{{ $user->profile?->selular ?? 'No HP belum diisi' }}</span></span>
                            <span class="flex items-center gap-1"><svg class="w-3.5 h-3.5 text-zinc-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg><span>{{ $user->profile?->kota_nama ?? 'Kota' }},
                                    {{ $user->profile?->provinsi_nama ?? 'Provinsi' }}</span></span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-start sm:self-center">
                    <button type="button" @click="openModal('edit')"
                        class="min-h-[44px] inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-xs font-semibold text-zinc-800 dark:text-zinc-200 transition-colors shadow-sm">
                        <svg class="w-4 h-4 text-[#1ca093] dark:text-[#2dd4bf]" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <span>Edit Profil Utama</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- 2 Columns Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- KIRI: Pengalaman, Pendidikan, Kursus -->
            <div class="lg:col-span-2 space-y-6">

                <!-- Data Diri (Soft Neutral) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-gradient-to-br from-zinc-50/50 via-white to-white dark:from-zinc-800/20 dark:via-zinc-900 dark:to-zinc-900 shadow-sm">
                    <h2
                        class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-4 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                        Data Diri</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs">
                        <div><span class="block text-zinc-400 mb-1">NIK (No. KTP)</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->no_ktp ?? '-' }}</span>
                        </div>
                        <div><span class="block text-zinc-400 mb-1">Jenis Kelamin</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100 capitalize">{{ $user->profile?->jenis_kelamin ?? '-' }}</span>
                        </div>
                        <div><span class="block text-zinc-400 mb-1">Tempat, Tanggal Lahir</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->tempat_lahir ?? '-' }},
                                {{ $user->profile?->tgl_lahir ? \Carbon\Carbon::parse($user->profile->tgl_lahir)->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                        <div><span class="block text-zinc-400 mb-1">Agama</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100 capitalize">{{ $user->profile?->agama_label }}</span>
                        </div>
                        <div><span class="block text-zinc-400 mb-1">Status Pernikahan</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100 capitalize">{{ $user->profile?->status_pernikahan_label }}</span>
                        </div>
                        <div>
                            <span class="block text-zinc-400 mb-1">Golongan Darah</span>
                            <span
                                class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->gol_darah_label }}</span>
                        </div>
                    </div>
                </div>

                <!-- Lamaran Terakhir -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-zinc-100 dark:border-zinc-800">
                        <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Lamaran Terakhir</h2>
                        <a href="{{ route('candidate.applications') }}"
                            class="text-xs text-[#1ca093] hover:underline font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-3 text-xs">
                        @forelse($user->applications->take(3) as $app)
                            <div
                                class="flex items-start justify-between gap-3 p-3 rounded-xl border border-zinc-100 bg-zinc-50/50 dark:border-zinc-800 dark:bg-zinc-800/30">
                                <div class="min-w-0">
                                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100 truncate">
                                        {{ $app->jobListing->title ?? 'Lowongan Telah Dihapus' }}
                                    </h3>
                                    <p class="text-zinc-500 text-[11px] mt-0.5">{{ $app->jobListing->company ?? '-' }}</p>
                                    <p class="text-[10px] text-zinc-400 mt-1">Dilamar:
                                        {{ \Carbon\Carbon::parse($app->applied_at)->format('d M Y') }}
                                    </p>
                                </div>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold shrink-0
                                                    {{ $app->status === 'applied' ? 'bg-blue-100 text-blue-700' : '' }}
                                                    {{ $app->status === 'interview' ? 'bg-amber-100 text-amber-700' : '' }}
                                                    {{ $app->status === 'diterima' ? 'bg-emerald-100 text-emerald-700' : '' }}
                                                    {{ $app->status === 'ditolak' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>
                        @empty
                            <p class="text-zinc-500 italic">Belum ada lamaran.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <!-- Pengalaman Kerja (Timeline Teal) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-teal-100 bg-gradient-to-br from-teal-50/30 via-white to-white dark:border-teal-900/30 dark:from-teal-950/10 dark:via-zinc-900 dark:to-zinc-900 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-teal-100/50 dark:border-teal-900/30">
                        <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Pengalaman Kerja</h2>
                        <button type="button" @click="openModal('experience')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-teal-100 text-teal-800 hover:bg-teal-500 hover:text-white dark:bg-teal-900/30 dark:text-teal-300 dark:hover:bg-teal-500 dark:hover:text-white text-xs font-semibold transition-all shadow-sm active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div class="relative border-l-2 border-teal-200/60 dark:border-teal-900/50 ml-3 space-y-6 mt-4">
                        @forelse($user->experiences ?? [] as $exp)
                            <div class="relative pl-6 group">
                                <span
                                    class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-white dark:bg-zinc-900 border-[3px] border-teal-400 shadow-sm"></span>
                                <div class="flex items-start justify-between gap-3.5">
                                    <div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">{{ $exp->jabatan }}
                                        </h3>
                                        <p class="text-xs font-medium text-teal-600 dark:text-teal-400">{{ $exp->perusahaan }}
                                        </p>
                                        <p
                                            class="text-[10px] text-zinc-500 font-medium bg-white dark:bg-zinc-800 inline-block px-2 py-0.5 rounded border border-zinc-200 dark:border-zinc-700 mt-1.5">
                                            {{ \Carbon\Carbon::parse($exp->tgl_masuk)->format('M Y') }} —
                                            {{ \Carbon\Carbon::parse($exp->tgl_keluar)->format('M Y') }}
                                        </p>
                                        <p class="text-zinc-600 dark:text-zinc-400 mt-2 text-xs leading-relaxed">
                                            {{ $exp->deskripsi }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0">
                                        <button type="button" @click="openModal('experience', {{ $exp }})"
                                            class="p-1.5 text-zinc-400 hover:text-teal-600 bg-white dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm"><svg
                                                class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg></button>
                                        <button type="button" @click="confirmDelete('experience', {{ $exp->id }})"
                                            class="p-1.5 text-zinc-400 hover:text-red-500 bg-white dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm"><svg
                                                class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg></button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-zinc-500 text-xs italic pl-6">Belum ada pengalaman kerja.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Pendidikan (Timeline Biru) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50/30 via-white to-white dark:border-blue-900/30 dark:from-blue-950/10 dark:via-zinc-900 dark:to-zinc-900 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-blue-100/50 dark:border-blue-900/30">
                        <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Riwayat Pendidikan</h2>
                        <button type="button" @click="openModal('education')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-100 text-blue-800 hover:bg-blue-500 hover:text-white dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-500 dark:hover:text-white text-xs font-semibold transition-all shadow-sm active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div class="relative border-l-2 border-blue-200/60 dark:border-blue-900/50 ml-3 space-y-6 mt-4">
                        @forelse($user->educations ?? [] as $edu)
                            <div class="relative pl-6 group">
                                <span
                                    class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-white dark:bg-zinc-900 border-[3px] border-blue-400 shadow-sm"></span>
                                <div class="flex items-start justify-between gap-3.5">
                                    <div>
                                        <h3 class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">{{ $edu->nama }}</h3>
                                        <p class="text-xs font-medium text-blue-600 dark:text-blue-400">{{ $edu->jurusan }}</p>
                                        <p
                                            class="text-[10px] text-zinc-500 font-medium bg-white dark:bg-zinc-800 inline-block px-2 py-0.5 rounded border border-zinc-200 dark:border-zinc-700 mt-1.5">
                                            {{ $edu->periode_awal }} — {{ $edu->periode_akhir }}
                                        </p>
                                    </div>
                                    <div class="flex items-center gap-1 shrink-0">
                                        <button type="button" @click="openModal('education', {{ $edu }})"
                                            class="p-1.5 text-zinc-400 hover:text-blue-600 bg-white dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm"><svg
                                                class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg></button>
                                        <button type="button" @click="confirmDelete('education', {{ $edu->id }})"
                                            class="p-1.5 text-zinc-400 hover:text-red-500 bg-white dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm"><svg
                                                class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg></button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-zinc-500 text-xs italic pl-6">Belum ada riwayat pendidikan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Kursus (Soft Blue - Disamakan dengan Pendidikan) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-blue-100 bg-gradient-to-br from-blue-50/30 via-white to-white dark:border-blue-900/30 dark:from-blue-950/10 dark:via-zinc-900 dark:to-zinc-900 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-blue-100/50 dark:border-blue-900/30">
                        <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Kursus & Pelatihan</h2>
                        <button type="button" @click="openModal('course')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-blue-100 text-blue-800 hover:bg-blue-500 hover:text-white dark:bg-blue-900/30 dark:text-blue-300 dark:hover:bg-blue-500 dark:hover:text-white text-xs font-semibold transition-all shadow-sm active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div class="space-y-3 text-xs">
                        @forelse($user->courses ?? [] as $course)
                            <div
                                class="flex items-start justify-between gap-3 p-3 rounded-xl border border-blue-50 bg-white/60 dark:border-blue-900/20 dark:bg-zinc-800/40 group hover:shadow-sm transition-all">
                                <div class="min-w-0">
                                    <h3 class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $course->nama }}</h3>
                                    <p class="text-zinc-500 dark:text-zinc-400">{{ $course->lembaga }}</p>
                                    <p class="text-[11px] text-zinc-400 font-medium mt-0.5">{{ $course->periode_awal }} —
                                        {{ $course->periode_akhir }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    <button type="button" @click="openModal('course', {{ $course }})"
                                        class="p-1.5 text-zinc-400 hover:text-blue-600 bg-white dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm"><svg
                                            class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg></button>
                                    <button type="button" @click="confirmDelete('course', {{ $course->id }})"
                                        class="p-1.5 text-zinc-400 hover:text-red-500 bg-white dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700 shadow-sm"><svg
                                            class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </div>
                            </div>
                        @empty
                            <p class="text-zinc-500 text-xs italic">Belum ada data kursus.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- KANAN: Skill, Kontak, Sosmed, Kontak Darurat, Keluarga -->
            <div class="space-y-6">
                <!-- Keahlian / Skill (Soft Emerald - Disamakan dengan Keluarga, Badge Lebih Kecil) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50/30 via-white to-white dark:border-emerald-900/30 dark:from-emerald-950/10 dark:via-zinc-900 dark:to-zinc-900 shadow-sm space-y-4">
                    <div
                        class="flex items-center justify-between pb-3 border-b border-emerald-100/50 dark:border-emerald-900/30">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Keahlian</h3>
                        <button type="button" @click="openModal('skill')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-800 hover:bg-emerald-500 hover:text-white dark:bg-emerald-900/30 dark:text-emerald-300 dark:hover:bg-emerald-500 dark:hover:text-white text-xs font-semibold transition-all shadow-sm active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse($user->skills ?? [] as $userSkill)
                            @if($userSkill->skill)
                                <span
                                    class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-300 text-[11px] font-medium border border-emerald-200/60 dark:border-emerald-800/50 group transition-all">
                                    {{ $userSkill->skill->nama }}
                                    <button @click="confirmDelete('skill', {{ $userSkill->id }})"
                                        class="text-emerald-400 hover:text-red-500 focus:outline-none" title="Hapus keahlian">
                                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        @empty
                            <p class="text-zinc-500 text-xs italic">Belum ada keahlian.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Dokumen Pendukung -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-2 border-b border-zinc-100 dark:border-zinc-800">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Dokumen Pendukung</h3>
                        <button type="button" @click="openModal('document')"
                            class="text-xs text-[#1ca093] hover:underline font-medium">+ Unggah</button>
                    </div>
                    <div class="space-y-2 text-xs">
                        @forelse($user->documents as $doc)
                            <div class="flex items-center justify-between p-2 rounded-lg bg-zinc-50 dark:bg-zinc-800/50">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                        class="font-medium text-zinc-700 dark:text-zinc-300 hover:text-[#1ca093]">{{ $doc->nama }}</a>
                                </div>
                                <button @click="confirmDelete('document', {{ $doc->id }})"
                                    class="text-zinc-400 hover:text-red-500"><svg class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button>
                            </div>
                        @empty
                            <p class="text-zinc-500 italic">Belum ada dokumen.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Alamat & Kontak (Rapi) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm space-y-4">
                    <h3
                        class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                        Alamat & Kontak</h3>
                    <div class="text-xs space-y-4">
                        <div>
                            {{-- <span class="block text-zinc-400 mb-1.5">Alamat Domisili</span> --}}
                            <p class="text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                {{ $user->profile?->alamat ?? 'Belum diisi' }}
                                <br><span class="text-zinc-400">Kelurahan</span> {{ $user->profile?->kelurahan_nama }}
                                <br><span class="text-zinc-400">Kecamatan</span> {{ $user->profile?->kecamatan_nama }}
                                <br><span class="text-zinc-400">Kota/Kabupaten</span> {{ $user->profile?->kota_nama }}
                                <br><span class="text-zinc-400">Provinsi</span> {{ $user->profile?->provinsi_nama }}
                            </p>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="block text-zinc-400 mb-1">Telepon Rumah</span>
                                <span
                                    class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->telepon ?? '-' }}</span>
                            </div>
                            <div>
                                <span class="block text-zinc-400 mb-1">No. HP</span>
                                <span
                                    class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->selular ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-sm space-y-4">
                    <h3
                        class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                        Media Sosial</h3>
                    <div class="space-y-3 text-xs">
                        <div class="flex items-center justify-between"><span class="text-zinc-500">Facebook</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->facebook ?? '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between"><span class="text-zinc-500">Instagram</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->instagram ?? '-' }}</span>
                        </div>
                        <div class="flex items-center justify-between"><span class="text-zinc-500">TikTok</span><span
                                class="font-medium text-zinc-900 dark:text-zinc-100">{{ $user->profile?->tiktok ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Kontak Darurat (Soft Emerald - Disamakan dengan Keluarga) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50/30 via-white to-white dark:border-emerald-900/30 dark:from-emerald-950/10 dark:via-zinc-900 dark:to-zinc-900 shadow-sm space-y-4">
                    <div
                        class="flex items-center justify-between pb-3 border-b border-emerald-100/50 dark:border-emerald-900/30">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Kontak Darurat</h3>
                        <button type="button" @click="openModal('contact')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-800 hover:bg-emerald-500 hover:text-white dark:bg-emerald-900/30 dark:text-emerald-300 dark:hover:bg-emerald-500 dark:hover:text-white text-xs font-semibold transition-all shadow-sm active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div class="text-xs space-y-3">
                        @forelse($user->emergencyContacts ?? [] as $contact)
                            <div
                                class="flex items-start justify-between gap-2 p-3 rounded-xl border border-emerald-50 bg-white/60 dark:border-emerald-900/20 dark:bg-zinc-800/40 group hover:shadow-sm transition-all">
                                <div class="w-full">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $contact->nama }}</p>
                                        <span
                                            class="text-[10px] bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 px-1.5 py-0.5 rounded">{{ $contact->hubungan?->label() ?? '-' }}</span>
                                    </div>
                                    <p class="text-zinc-500">{{ $contact->kontak }}</p>
                                    <p class="text-zinc-400 text-[11px] mt-0.5 truncate">{{ $contact->alamat }}</p>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    <button type="button" @click="openModal('contact', {{ $contact }})"
                                        class="p-1 text-zinc-400 hover:text-emerald-600"><svg class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg></button>
                                    <button type="button" @click="confirmDelete('contact', {{ $contact->id }})"
                                        class="p-1 text-zinc-400 hover:text-red-500"><svg class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </div>
                            </div>
                        @empty
                            <p class="text-zinc-500 text-xs italic">Belum ada data.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Keluarga (Soft Emerald) -->
                <div
                    class="p-5 sm:p-6 rounded-2xl border border-emerald-100 bg-gradient-to-br from-emerald-50/30 via-white to-white dark:border-emerald-900/30 dark:from-emerald-950/10 dark:via-zinc-900 dark:to-zinc-900 shadow-sm space-y-4">
                    <div
                        class="flex items-center justify-between pb-3 border-b border-emerald-100/50 dark:border-emerald-900/30">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Data Keluarga</h3>
                        <button type="button" @click="openModal('family')"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-100 text-emerald-800 hover:bg-emerald-500 hover:text-white dark:bg-emerald-900/30 dark:text-emerald-300 dark:hover:bg-emerald-500 dark:hover:text-white text-xs font-semibold transition-all shadow-sm active:scale-95">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </button>
                    </div>
                    <div class="text-xs space-y-3">
                        @forelse($user->families ?? [] as $family)
                            <div
                                class="flex items-start justify-between gap-2 p-3 rounded-xl border border-emerald-50 bg-white/60 dark:border-emerald-900/20 dark:bg-zinc-800/40 group hover:shadow-sm transition-all">
                                <div class="w-full">
                                    <div class="flex items-center justify-between mb-1">
                                        <p class="font-semibold text-zinc-900 dark:text-zinc-100">{{ $family->nama }}</p>
                                        <span
                                            class="text-[10px] bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 px-1.5 py-0.5 rounded">{{ $family->hubungan?->label() ?? '-' }}</span>
                                    </div>
                                    <p class="text-zinc-500 capitalize">{{ $family->jenis_kelamin }} •
                                        {{ $family->tipe == 1 ? 'Keluarga I' : 'Keluarga II' }}
                                    </p>
                                    <p class="text-zinc-400 text-[11px] mt-0.5">{{ $family->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($family->tgl_lahir)->format('d M Y') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1 shrink-0">
                                    <button type="button" @click="openModal('family', {{ $family }})"
                                        class="p-1 text-zinc-400 hover:text-emerald-600"><svg class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg></button>
                                    <button type="button" @click="confirmDelete('family', {{ $family->id }})"
                                        class="p-1 text-zinc-400 hover:text-red-500"><svg class="w-3.5 h-3.5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </div>
                            </div>
                        @empty
                            <p class="text-zinc-500 text-xs italic">Belum ada data keluarga.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- PANGGIL SEMUA MODAL -->
        @include('public.profile.modal-edit')
        @include('public.profile.modal-education')
        @include('public.profile.modal-experience')
        @include('public.profile.modal-course')
        @include('public.profile.modal-contact')
        @include('public.profile.modal-family')
        @include('public.profile.modal-skill')
        @include('public.profile.modal-document')
        @include('public.profile.modal-delete')

    </div> <!-- Penutup x-data -->

    <!-- LOGIKA ALPINE.JS -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('profileCrud', () => ({
                mode: '',
                editId: null,
                loading: false,
                editTab: 'basic',
                deleteLoading: false,
                deleteTarget: {type: '', id: null},
                form: {},

                // STATE UNTUK EDIT PROFIL UTAMA
                editLoading: false,
                editError: '',
                editFotoPreview: '{{ $user->profile && $user->profile->foto ? asset('storage/uploads/' . $user->profile->foto) : '' }}',
                editFotoFile: null,
                editForm: {
                    nama: @js($user->profile?->nama ?? $user->username),
                    no_ktp: @js($user->profile?->no_ktp ?? ''),
                    jenis_kelamin: @js($user->profile?->jenis_kelamin ?? 'laki-laki'),
                    tempat_lahir: @js($user->profile?->tempat_lahir ?? ''),
                    tgl_lahir: @js($user->profile?->tgl_lahir ?? ''),
                    alamat: @js($user->profile?->alamat ?? ''),

                    //
                    provinsi_id: @js($user->profile?->provinsi_id ?? ''),
                    kota_id: @js($user->profile?->kota_id ?? ''),
                    kecamatan_id: @js($user->profile?->kecamatan_id ?? ''),
                    kelurahan_id: @js($user->profile?->kelurahan_id ?? ''),

                    telepon: @js($user->profile?->telepon ?? ''),
                    selular: @js($user->profile?->selular ?? ''),
                    agama: @js($user->profile?->agama ?? ''),
                    status_pernikahan: @js($user->profile?->status_pernikahan ?? ''),
                    gol_darah: @js($user->profile?->gol_darah ?? ''),
                    facebook: @js($user->profile?->facebook ?? ''),
                    instagram: @js($user->profile?->instagram ?? ''),
                    tiktok: @js($user->profile?->tiktok ?? ''),
                },

                openModal(mode, data = null) {
                    if (mode === 'edit') {
                        this.$dispatch('open-modal', 'edit-modal');
                        return;
                    }
                    this.mode = mode;

                    if (mode === 'document') {
                        this.form = {}; // Reset form
                        this.$dispatch('open-modal', 'document-modal');
                        return;
                    }


                    this.mode = mode;
                    this.editId = data ? data.id : null;
                    this.form = data ? {...data} : {};

                    if (this.mode === 'family' && !this.editId) this.form.tipe = '1';
                    if (this.mode === 'education' && !this.editId) this.form.tingkat = '3';

                    // Ambil value Enum untuk form edit
                    if (data) {
                        if (this.form.hubungan && typeof this.form.hubungan === 'object') this.form.hubungan = this.form.hubungan.value;
                        if (this.form.tingkat && typeof this.form.tingkat === 'object') this.form.tingkat = this.form.tingkat.value;
                    }

                    this.$dispatch('open-modal', this.mode + '-modal');
                },

                handleEditFile(e) {
                    const file = e.target.files[0];
                    if (file) {
                        this.editFotoFile = file;
                        this.editFotoPreview = URL.createObjectURL(file);
                    }
                },

                async submitEdit() {
                    this.editLoading = true;
                    this.editError = '';

                    const formData = new FormData();
                    Object.keys(this.editForm).forEach(key => {
                        if (this.editForm[key] !== null && this.editForm[key] !== undefined) {
                            formData.append(key, this.editForm[key]);
                        }
                    });
                    if (this.editFotoFile) formData.append('foto', this.editFotoFile);

                    try {
                        const response = await fetch('{{ route('candidate.profile.update') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: formData
                        });

                        const data = await response.json();

                        if (response.ok) {
                            window.location.href = data.redirect;
                        } else {
                            if (data.errors) {
                                // Tampilkan pesan error
                                this.editError = Object.values(data.errors).flat().join(' ');

                                // 👇 Auto-switch ke tab yang error 👇
                                const errorKeys = Object.keys(data.errors);
                                if (errorKeys.some(k => ['nama', 'tempat_lahir', 'tgl_lahir'].includes(k))) {
                                    this.editTab = 'basic';
                                } else if (errorKeys.some(k => ['agama', 'status_pernikahan', 'selular', 'telepon'].includes(k))) {
                                    this.editTab = 'detail';
                                } else if (errorKeys.some(k => ['alamat', 'provinsi_id', 'kota_id', 'kecamatan_id', 'kelurahan_id'].includes(k))) {
                                    this.editTab = 'alamat';
                                } else if (errorKeys.some(k => ['facebook', 'instagram', 'tiktok'].includes(k))) {
                                    this.editTab = 'sosmed';
                                }
                            } else {
                                this.editError = data.message || 'Gagal menyimpan profil.';
                            }
                            this.editLoading = false;
                        }
                    } catch (err) {
                        this.editError = 'Terjadi kesalahan jaringan.';
                        this.editLoading = false;
                    }
                },

                async submitForm() {
                    this.loading = true;

                    if (this.mode === 'document') {
                        const formData = new FormData();
                        formData.append('nama', this.form.nama);
                        formData.append('file', this.form.file);

                        try {
                            const res = await fetch('{{ route("profile.document.store") }}', {
                                method: 'POST',
                                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
                                body: formData
                            });
                            if (res.ok) window.location.reload();
                        } catch (e) {alert('Gagal mengunggah');}
                        this.loading = false;
                        return;
                    }

                    let url = this.editId
                        ? `/profile/${this.mode}/${this.editId}`
                        : `/profile/${this.mode}`;
                    let method = this.editId ? 'PUT' : 'POST';

                    try {
                        const res = await fetch(url, {
                            method: method,
                            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'},
                            body: JSON.stringify(this.form)
                        });

                        if (res.ok) {
                            this.$dispatch('close-modal', this.mode + '-modal');
                            this.$store.toasts.add({title: 'Berhasil!', message: 'Data berhasil disimpan.', type: 'success'});
                            setTimeout(() => {window.location.reload();}, 1500);
                        } else {
                            this.$store.toasts.add({title: 'Gagal', message: 'Gagal menyimpan data.', type: 'error'});
                        }
                    } catch (e) {
                        this.$store.toasts.add({title: 'Error', message: 'Terjadi kesalahan jaringan.', type: 'error'});
                    }
                    this.loading = false;
                },

                confirmDelete(type, id) {
                    this.deleteTarget = {type, id};
                    this.$dispatch('open-modal', 'delete-modal');
                },

                async executeDelete() {
                    this.deleteLoading = true;
                    try {
                        const res = await fetch(`/profile/${this.deleteTarget.type}/${this.deleteTarget.id}`, {
                            method: 'DELETE',
                            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}
                        });
                        if (res.ok) {
                            this.$dispatch('close-modal', 'delete-modal');
                            this.$store.toasts.add({title: 'Dihapus!', message: 'Data berhasil dihapus.', type: 'info'});
                            setTimeout(() => {window.location.reload();}, 1500);
                        }
                    } catch (e) {
                        this.$store.toasts.add({title: 'Error', message: 'Gagal menghapus data.', type: 'error'});
                    }
                    this.deleteLoading = false;
                },

                // State untuk Dropdown Wilayah
                provinsiOptions: [],
                kotaOptions: [],
                kecamatanOptions: [],
                kelurahanOptions: [],

                async init() {
                    await this.fetchProvinsi();
                    if (this.editForm.provinsi_id) {
                        await this.fetchKota(this.editForm.provinsi_id, false);
                        if (this.editForm.kota_id) {
                            await this.fetchKecamatan(this.editForm.kota_id, false);
                            if (this.editForm.kecamatan_id) {
                                await this.fetchKelurahan(this.editForm.kecamatan_id);
                            }
                        }
                    }
                },

                async fetchProvinsi() {
                    const res = await fetch('{{ route("api.wilayah") }}?level=provinsi');
                    this.provinsiOptions = await res.json();
                },

                async fetchKota(provinsiKode, reset = true) {
                    if (reset) {
                        this.editForm.kota = '';
                        this.editForm.kecamatan = '';
                        this.editForm.kelurahan = '';
                        this.kecamatanOptions = [];
                        this.kelurahanOptions = [];
                    }
                    this.kotaOptions = [];
                    if (!provinsiKode) return;

                    try {
                        const res = await fetch(`{{ route("api.wilayah") }}?level=kota&parent=${provinsiKode}`);
                        const data = await res.json();
                        // Pastikan data yang diterima adalah Array
                        this.kotaOptions = Array.isArray(data) ? data : [];
                    } catch (e) {
                        this.kotaOptions = [];
                    }
                },

                async fetchKecamatan(kotaKode, reset = true) {
                    if (reset) {
                        this.editForm.kecamatan = '';
                        this.editForm.kelurahan = '';
                        this.kelurahanOptions = [];
                    }
                    this.kecamatanOptions = [];
                    if (!kotaKode) return;

                    try {
                        const res = await fetch(`{{ route("api.wilayah") }}?level=kecamatan&parent=${kotaKode}`);
                        const data = await res.json();
                        this.kecamatanOptions = Array.isArray(data) ? data : [];
                    } catch (e) {
                        this.kecamatanOptions = [];
                    }
                },

                async fetchKelurahan(kecamatanKode) {
                    this.editForm.kelurahan = '';
                    this.kelurahanOptions = [];
                    if (!kecamatanKode) return;

                    try {
                        const res = await fetch(`{{ route("api.wilayah") }}?level=kelurahan&parent=${kecamatanKode}`);
                        const data = await res.json();
                        this.kelurahanOptions = Array.isArray(data) ? data : [];
                    } catch (e) {
                        this.kelurahanOptions = [];
                    }
                },
            }));
        });
    </script>
@endsection