@extends('layouts.public', ['title' => 'Riwayat Lamaran Pekerjaan — Budi Pratama'])

@section('content')
<div 
    x-data="{
        statusFilter: 'all',
        searchQuery: '',
        applications: [
            {
                id: 101,
                position: 'Senior Laravel & Cloud Architect',
                company: 'PT Fintek Sinergi Indonesia',
                logo: 'FS',
                location: 'Jakarta Selatan (Hybrid)',
                salary: 'Rp 28jt - 42jt',
                applied_date: '18 Okt 2026',
                status: 'interview',
                status_label: 'Wawancara Tahap 2',
                notes: 'Jadwal wawancara teknis pada 28 Okt 2026, 14:00 WIB via Google Meet.'
            },
            {
                id: 102,
                position: 'Lead Backend Developer',
                company: 'Bank Digital Nusantara',
                logo: 'BD',
                location: 'Jakarta Pusat (Hybrid)',
                salary: 'Rp 30jt - 45jt',
                applied_date: '12 Okt 2026',
                status: 'under_review',
                status_label: 'Sedang Ditinjau',
                notes: 'Berkas dan portofolio sedang dinilai oleh Tim Engineering Lead.'
            },
            {
                id: 103,
                position: 'Staff Systems Architect',
                company: 'Global Retail Inovasi',
                logo: 'GR',
                location: 'Tangerang / Remote',
                salary: 'Rp 25jt - 35jt',
                applied_date: '04 Okt 2026',
                status: 'accepted',
                status_label: 'Penawaran Kerja (Offering)',
                notes: 'Selamat! Surat penawaran kerja resmi telah dikirim ke email Anda.'
            },
            {
                id: 104,
                position: 'Senior DevOps Specialist',
                company: 'Mega Logistik Express',
                logo: 'ML',
                location: 'Jakarta Timur (Onsite)',
                salary: 'Rp 20jt - 28jt',
                applied_date: '25 Sep 2026',
                status: 'rejected',
                status_label: 'Belum Sesuai',
                notes: 'Kandidat lain dengan spesifikasi on-premise hardware telah dipilih.'
            }
        ],
        filteredApplications() {
            return this.applications.filter(app => {
                const matchStatus = this.statusFilter === 'all' || app.status === this.statusFilter;
                const matchSearch = !this.searchQuery || 
                    app.position.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    app.company.toLowerCase().includes(this.searchQuery.toLowerCase());
                return matchStatus && matchSearch;
            });
        }
    }"
    class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10"
>
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-zinc-200/80 dark:border-zinc-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                Riwayat Lamaran Saya
            </h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                Pantau status berkas, jadwal wawancara, dan tahapan seleksi lowongan yang telah Anda lamar.
            </p>
        </div>

        <a
            href="{{ route('home') ?? '/' }}"
            class="min-h-[44px] inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#1ca093] text-white text-xs font-semibold hover:bg-[#168579] active:bg-[#137267] shadow-sm shadow-[#1ca093]/20 transition-colors self-start sm:self-auto cursor-pointer"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <span>Cari Lowongan Baru</span>
        </a>
    </div>

    <!-- Filter Tabs & Search Bar -->
    <div class="mt-6 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
        <!-- Filter Tabs -->
        <div class="flex items-center gap-1 bg-zinc-100 dark:bg-zinc-900 p-1 rounded-xl text-xs overflow-x-auto">
            <button
                type="button"
                @click="statusFilter = 'all'"
                class="min-h-[36px] px-3.5 py-1.5 rounded-lg transition-colors whitespace-nowrap cursor-pointer text-xs"
                :class="statusFilter === 'all' ? 'bg-white dark:bg-zinc-800 font-semibold shadow-xs text-[#1ca093] dark:text-[#2dd4bf]' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900'"
            >
                Semua (<span x-text="applications.length"></span>)
            </button>
            <button
                type="button"
                @click="statusFilter = 'under_review'"
                class="min-h-[36px] px-3.5 py-1.5 rounded-lg transition-colors whitespace-nowrap cursor-pointer text-xs"
                :class="statusFilter === 'under_review' ? 'bg-white dark:bg-zinc-800 font-semibold shadow-xs text-[#1ca093] dark:text-[#2dd4bf]' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900'"
            >
                Ditinjau
            </button>
            <button
                type="button"
                @click="statusFilter = 'interview'"
                class="min-h-[36px] px-3.5 py-1.5 rounded-lg transition-colors whitespace-nowrap cursor-pointer text-xs"
                :class="statusFilter === 'interview' ? 'bg-white dark:bg-zinc-800 font-semibold shadow-xs text-[#1ca093] dark:text-[#2dd4bf]' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900'"
            >
                Wawancara
            </button>
            <button
                type="button"
                @click="statusFilter = 'accepted'"
                class="min-h-[36px] px-3.5 py-1.5 rounded-lg transition-colors whitespace-nowrap cursor-pointer text-xs"
                :class="statusFilter === 'accepted' ? 'bg-white dark:bg-zinc-800 font-semibold shadow-xs text-[#1ca093] dark:text-[#2dd4bf]' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900'"
            >
                Offering
            </button>
        </div>

        <!-- Search input -->
        <div class="relative w-full sm:w-64">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-zinc-400">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input
                type="text"
                x-model="searchQuery"
                placeholder="Cari posisi atau perusahaan..."
                class="w-full min-h-[38px] rounded-xl border border-zinc-200 bg-white pl-8 pr-3 py-1.5 text-xs text-zinc-900 placeholder-zinc-400 focus:border-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 focus:outline-none dark:border-zinc-800 dark:bg-zinc-850 dark:text-zinc-100 dark:placeholder-zinc-500"
            />
        </div>
    </div>

    <!-- Application Cards List -->
    <div class="mt-6 space-y-4">
        <template x-for="app in filteredApplications()" :key="app.id">
            <div class="p-5 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs hover:border-[#1ca093]/40 dark:hover:border-[#1ca093]/40 transition-colors">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <!-- Left: Logo & Job Details -->
                    <div class="flex items-start gap-3.5 sm:gap-4 flex-1 min-w-0">
                        <div class="w-12 h-12 rounded-xl bg-[#e7f6f3] text-[#1ca093] dark:bg-[#1ca093]/20 dark:text-[#2dd4bf] border border-[#1ca093]/20 flex items-center justify-center font-bold text-sm shrink-0">
                            <span x-text="app.logo"></span>
                        </div>

                        <div class="min-w-0 flex-1">
                            <a 
                                :href="'/profile/applications/' + app.id" 
                                class="text-sm font-bold text-zinc-900 dark:text-zinc-100 hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors line-clamp-1"
                                x-text="app.position"
                            ></a>

                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                                <span class="font-medium text-zinc-700 dark:text-zinc-300" x-text="app.company"></span>
                                <span class="mx-1">•</span>
                                <span x-text="app.location"></span>
                            </p>

                            <!-- Notes snippet -->
                            <div class="mt-2 text-xs text-zinc-600 dark:text-zinc-400 bg-zinc-50 dark:bg-zinc-800/40 p-2.5 rounded-xl border border-zinc-100 dark:border-zinc-800">
                                <span class="text-zinc-400 font-medium">Catatan Rekruter:</span>
                                <span class="ml-1" x-text="app.notes"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Status Badge & Link -->
                    <div class="flex sm:flex-col items-center sm:items-end justify-between gap-2.5 shrink-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-zinc-100 dark:border-zinc-800">
                        <!-- Status Badge (Preserving semantic colors, with interview using brand teal) -->
                        <span 
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold"
                            :class="{
                                'bg-[#e7f6f3] text-[#168579] border border-[#1ca093]/25 dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] dark:border-[#1ca093]/30': app.status === 'interview',
                                'bg-amber-50 text-amber-700 border border-amber-200 dark:bg-amber-950/60 dark:text-amber-300 dark:border-amber-900': app.status === 'under_review',
                                'bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 dark:border-emerald-900': app.status === 'accepted',
                                'bg-red-50 text-red-700 border border-red-200 dark:bg-red-950/60 dark:text-red-300 dark:border-red-900': app.status === 'rejected'
                            }"
                        >
                            <span 
                                class="w-1.5 h-1.5 rounded-full"
                                :class="{
                                    'bg-[#1ca093]': app.status === 'interview',
                                    'bg-amber-500': app.status === 'under_review',
                                    'bg-emerald-500': app.status === 'accepted',
                                    'bg-red-500': app.status === 'rejected'
                                }"
                            ></span>
                            <span x-text="app.status_label"></span>
                        </span>

                        <span class="text-[11px] text-zinc-400" x-text="'Melamar: ' + app.applied_date"></span>

                        <a
                            :href="'/profile/applications/' + app.id"
                            class="inline-flex items-center gap-1 text-xs font-semibold text-[#1ca093] dark:text-[#2dd4bf] hover:underline"
                        >
                            <span>Lihat Detail Timeline</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <!-- Empty State -->
    <div x-show="filteredApplications().length === 0" style="display: none;" class="mt-8">
        <x-ui.empty-state
            title="Tidak ada riwayat lamaran yang sesuai"
            description="Anda belum memiliki lamaran dengan filter status ini atau tidak ada hasil pencarian."
        >
            <button
                type="button"
                @click="statusFilter = 'all'; searchQuery = ''"
                class="min-h-[44px] px-5 py-2.5 rounded-xl bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-900 text-xs font-semibold cursor-pointer"
            >
                Reset Filter
            </button>
        </x-ui.empty-state>
    </div>

    <!-- Pagination -->
    <div class="pt-8">
        <x-ui.pagination :currentPage="1" :totalPages="1" :totalRecords="4" :perPage="10" />
    </div>
</div>
@endsection
