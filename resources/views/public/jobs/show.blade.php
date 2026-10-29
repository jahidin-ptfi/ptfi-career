@extends('layouts.public', ['title' => 'Senior Laravel & Cloud Architect — PT Fintek Sinergi Indonesia'])

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8" x-data="{
    bookmarked: false,
    applied: false,
    applyModalOpen: false,
    submitting: false,
    submitApplication() {
        this.submitting = true;
        setTimeout(() => {
            this.submitting = false;
            this.applied = true;
            this.applyModalOpen = false;
            $store.toasts.add({ title: 'Lamaran Berhasil Dikirim!', message: 'Berkas lamaran Anda telah diterima oleh tim HR.', type: 'success' });
        }, 800);
    }
}">
    <!-- Breadcrumb with horizontal scroll safety on mobile -->
    <div class="mb-5 overflow-x-auto pb-1 -mx-4 px-4 sm:mx-0 sm:px-0">
        <nav class="flex items-center text-xs text-zinc-500 dark:text-zinc-400 whitespace-nowrap">
            <a href="{{ route('home') ?? '/' }}" class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Lowongan Pekerjaan</a>
            <span class="mx-2 text-zinc-300 dark:text-zinc-700">/</span>
            <a href="{{ route('home') ?? '/' }}" class="hover:text-[#1ca093] dark:hover:text-[#2dd4bf] transition-colors">Software Engineering</a>
            <span class="mx-2 text-zinc-300 dark:text-zinc-700">/</span>
            <span class="text-zinc-800 dark:text-zinc-200 font-medium">Senior Laravel & Cloud Architect</span>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8 items-start">
        <!-- Main Job Info Column (2 cols) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Job Header Card -->
            <div class="p-5 sm:p-7 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs">
                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-5 pb-6 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-start gap-4">
                        <div class="w-13 h-13 sm:w-14 sm:h-14 rounded-2xl bg-[#e7f6f3] text-[#1ca093] dark:bg-[#1ca093]/15 dark:text-[#2dd4bf] border border-[#1ca093]/20 flex items-center justify-center font-bold text-lg shrink-0">
                            FS
                        </div>
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-2">
                                <h1 class="text-lg sm:text-2xl font-bold tracking-tight text-zinc-900 dark:text-white">
                                    Senior Laravel & Cloud Architect
                                </h1>
                                <x-ui.badge variant="success" dot="true">Aktif Merekrut</x-ui.badge>
                            </div>
                            <p class="mt-1 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400">
                                <span class="font-medium text-zinc-800 dark:text-zinc-200">PT Fintek Sinergi Indonesia</span>
                                <span class="mx-1.5">•</span>
                                <span>Jakarta Selatan (SCBD)</span>
                                <span class="mx-1.5">•</span>
                                <span class="text-zinc-400 text-xs">Diposting 2 hari yang lalu</span>
                            </p>
                        </div>
                    </div>

                    <!-- Bookmark Action -->
                    <div class="flex items-center gap-2 self-end sm:self-start">
                        <button
                            type="button"
                            @click="bookmarked = !bookmarked; $store.toasts.add({ title: bookmarked ? 'Disimpan' : 'Dihapus', message: bookmarked ? 'Lowongan disimpan ke daftar bookmark.' : 'Lowongan dihapus dari bookmark.', type: 'info' })"
                            class="min-h-[44px] min-w-[44px] p-2.5 rounded-xl border border-zinc-200 dark:border-zinc-800 text-zinc-400 hover:text-amber-500 hover:border-amber-300 dark:hover:border-amber-700/60 transition-colors cursor-pointer flex items-center justify-center"
                            title="Simpan Lowongan"
                        >
                            <svg class="w-5 h-5" :class="bookmarked ? 'fill-amber-500 text-amber-500' : 'fill-none text-current'" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Highlight Metrics Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 py-5 border-b border-zinc-100 dark:border-zinc-800 text-xs">
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Gaji Ditawarkan</span>
                        <span class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">Rp 28jt - 42jt</span>
                        <span class="text-[10px] text-zinc-400 block">/ bulan (Gross)</span>
                    </div>
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Sistem Kerja</span>
                        <span class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">Hybrid</span>
                        <span class="text-[10px] text-zinc-400 block">2 hari kantor, 3 hari remote</span>
                    </div>
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Pengalaman</span>
                        <span class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">Senior (5+ Thn)</span>
                        <span class="text-[10px] text-zinc-400 block">Backend & Cloud</span>
                    </div>
                    <div>
                        <span class="text-zinc-400 block mb-0.5">Tipe Pekerjaan</span>
                        <span class="font-semibold text-zinc-900 dark:text-zinc-100 text-sm">Full-Time</span>
                        <span class="text-[10px] text-zinc-400 block">Karyawan Tetap</span>
                    </div>
                </div>

                <!-- Apply Banner Action -->
                <div class="pt-5 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-zinc-500 dark:text-zinc-400 text-center sm:text-left">
                        Batas akhir pendaftaran: <span class="font-semibold text-zinc-800 dark:text-zinc-200">15 November 2026</span>
                    </div>

                    <div class="w-full sm:w-auto">
                        <template x-if="!applied">
                            <button
                                type="button"
                                @click="applyModalOpen = true"
                                class="w-full sm:w-auto min-h-[44px] inline-flex items-center justify-center font-semibold transition-all text-xs px-6 py-2.5 rounded-xl gap-2 bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] shadow-sm shadow-[#1ca093]/20 cursor-pointer"
                            >
                                <span>Lamar Posisi Ini</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>
                        </template>

                        <template x-if="applied">
                            <div class="min-h-[44px] w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800 text-xs font-semibold">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Lamaran Sudah Terkirim</span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Job Description Detail Card -->
            <div class="p-5 sm:p-7 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs space-y-6 text-xs leading-relaxed text-zinc-600 dark:text-zinc-400">
                <!-- Deskripsi -->
                <div>
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-2">
                        Deskripsi Pekerjaan
                    </h2>
                    <p class="leading-relaxed">
                        PT Fintek Sinergi Indonesia mencari <strong>Senior Laravel & Cloud Architect</strong> untuk merancang, mengoptimalkan, dan memelihara arsitektur backend inti perbankan open API. Anda akan berkolaborasi dengan tim lintas fungsi untuk memastikan sistem beroperasi dengan ketersediaan tinggi 99.99% dan latency di bawah 80ms per transaksi.
                    </p>
                </div>

                <!-- Tanggung Jawab -->
                <div class="pt-5 border-t border-zinc-100 dark:border-zinc-800">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-3">
                        Tanggung Jawab Utama
                    </h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Merancang arsitektur microservices dan API perbankan berbasis Laravel 13, Octane, dan PostgreSQL.</li>
                        <li>Memastikan sistem terukur dan tahan lonjakan beban transaksi (handling 10.000+ RPS).</li>
                        <li>Mengatur infrastruktur cloud AWS menggunakan Kubernetes (EKS), Terraform, dan Docker.</li>
                        <li>Menjamin standar keamanan ISO 27001 dan regulasi Bank Indonesia.</li>
                        <li>Membimbing engineer junior dan menyelenggarakan sesi knowledge-sharing arsitektur.</li>
                    </ul>
                </div>

                <!-- Kualifikasi -->
                <div class="pt-5 border-t border-zinc-100 dark:border-zinc-800">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-3">
                        Kualifikasi & Persyaratan
                    </h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Pengalaman profesional minimal 5 tahun dalam ekosistem PHP modern dan framework Laravel.</li>
                        <li>Keahlian mendalam dalam relasional database (PostgreSQL/MySQL) query tuning dan caching layer (Redis).</li>
                        <li>Pengalaman nyata dengan arsitektur Event-Driven menggunakan Apache Kafka atau RabbitMQ.</li>
                        <li>Familiaritas dengan metodologi Agile / Scrum dan praktik CI/CD modern (GitHub Actions).</li>
                        <li>Gelar S1 di bidang Ilmu Komputer, Teknik Informatika, atau pengalaman kerja setara yang relevan.</li>
                    </ul>
                </div>

                <!-- Benefit -->
                <div class="pt-5 border-t border-zinc-100 dark:border-zinc-800">
                    <h2 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100 mb-3">
                        Keuntungan & Fasilitas
                    </h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Gaji pokok kompetitif dengan peninjauan berkala tiap tahun.</li>
                        <li>Asuransi kesehatan swasta mencakup rawat inap dan rawat jalan bagi karyawan dan keluarga.</li>
                        <li>Perangkat kerja MacBook Pro 16" M3 Max beserta tunjangan monitor 4K.</li>
                        <li>Alokasi anggaran pelatihan dan sertifikasi internasional (AWS Certified Solutions Architect, dll).</li>
                        <li>Cuti tahunan 18 hari kerja dan kebijakan libur hari ulang tahun.</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right: Company Sidebar & Similar Jobs -->
        <div class="space-y-6">
            <!-- Company Profile Card -->
            <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs space-y-4">
                <div class="flex items-center gap-3 pb-3 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="w-10 h-10 rounded-xl bg-[#e7f6f3] text-[#1ca093] dark:bg-[#1ca093]/20 dark:text-[#2dd4bf] font-bold flex items-center justify-center text-sm border border-[#1ca093]/20">
                        FS
                    </div>
                    <div class="min-w-0">
                        <h3 class="text-xs sm:text-sm font-semibold text-zinc-900 dark:text-zinc-100 truncate">PT Fintek Sinergi Indonesia</h3>
                        <p class="text-[11px] text-zinc-400">Fintech & Pembayaran Digital</p>
                    </div>
                </div>

                <div class="space-y-2.5 text-xs text-zinc-600 dark:text-zinc-400">
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Ukuran Perusahaan</span>
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">250 - 500 Karyawan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Lokasi Kantor</span>
                        <span class="font-medium text-zinc-800 dark:text-zinc-200">Jakarta Selatan</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-zinc-400">Website</span>
                        <a href="#" class="text-[#1ca093] dark:text-[#2dd4bf] hover:underline">www.finteksinergi.id</a>
                    </div>
                </div>

                <p class="text-xs text-zinc-500 leading-relaxed border-t border-zinc-100 dark:border-zinc-800 pt-3">
                    Pelopor gateway pembayaran digital dan open banking di Indonesia yang bermitra dengan lebih dari 20.000 merchant nasional.
                </p>
            </div>

            <!-- Similar Jobs Recommendations -->
            <div class="p-5 sm:p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs space-y-3.5">
                <h3 class="text-xs sm:text-sm font-semibold text-zinc-900 dark:text-zinc-100">Lowongan Serupa</h3>

                <div class="space-y-2.5">
                    <a href="{{ route('home') ?? '/' }}" class="block p-3 rounded-xl border border-zinc-200/70 dark:border-zinc-800 hover:border-[#1ca093]/50 transition-colors">
                        <h4 class="text-xs font-semibold text-zinc-900 dark:text-zinc-100">Lead Backend Engineer</h4>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">Bank Digital Nusantara • Jakarta</p>
                        <p class="text-[11px] font-medium text-emerald-600 dark:text-emerald-400 mt-1">Rp 30jt - 45jt</p>
                    </a>

                    <a href="{{ route('home') ?? '/' }}" class="block p-3 rounded-xl border border-zinc-200/70 dark:border-zinc-800 hover:border-[#1ca093]/50 transition-colors">
                        <h4 class="text-xs font-semibold text-zinc-900 dark:text-zinc-100">DevOps & Site Reliability Engineer</h4>
                        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-0.5">Cloud Data Indonesia • Remote</p>
                        <p class="text-[11px] font-medium text-emerald-600 dark:text-emerald-400 mt-1">Rp 22jt - 35jt</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- APPLY SUBMISSION MODAL -->
    <div
        x-show="applyModalOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 flex items-center justify-center"
        style="display: none;"
    >
        <div class="fixed inset-0 bg-zinc-950/60 backdrop-blur-xs transition-opacity" @click="applyModalOpen = false"></div>

        <div class="relative w-full max-w-lg max-h-[90dvh] overflow-y-auto rounded-2xl border border-zinc-200 bg-white p-5 sm:p-6 shadow-2xl dark:border-zinc-800 dark:bg-zinc-900 text-left">
            <div class="flex items-start justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800 sticky top-0 bg-white dark:bg-zinc-900 z-10">
                <div class="min-w-0 pr-4">
                    <h3 class="text-base font-bold text-zinc-900 dark:text-zinc-100">Kirim Lamaran Pekerjaan</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5 truncate">Senior Laravel & Cloud Architect — PT Fintek Sinergi</p>
                </div>
                <button 
                    @click="applyModalOpen = false" 
                    type="button"
                    class="min-h-[44px] min-w-[44px] flex items-center justify-center text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 rounded-lg"
                    aria-label="Tutup Modal"
                >
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form @submit.prevent="submitApplication()" class="mt-4 space-y-4 text-xs">
                @csrf
                <div class="space-y-1.5">
                    <label class="block font-medium text-zinc-700 dark:text-zinc-300">Nama Lengkap</label>
                    <input 
                        type="text" 
                        value="Budi Pratama" 
                        required 
                        class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 px-3 py-2.5 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:border-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 dark:focus:border-[#1ca093] dark:focus:ring-[#1ca093]/25 outline-none"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="block font-medium text-zinc-700 dark:text-zinc-300">Email Kontak</label>
                    <input 
                        type="email" 
                        value="budi.pratama@example.com" 
                        required 
                        class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 px-3 py-2.5 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:border-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 dark:focus:border-[#1ca093] dark:focus:ring-[#1ca093]/25 outline-none"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="block font-medium text-zinc-700 dark:text-zinc-300">Nomor WhatsApp / Telepon</label>
                    <input 
                        type="tel" 
                        value="+62 812-3456-7890" 
                        required 
                        class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 px-3 py-2.5 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:border-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 dark:focus:border-[#1ca093] dark:focus:ring-[#1ca093]/25 outline-none"
                    >
                </div>

                <div class="space-y-1.5">
                    <label class="block font-medium text-zinc-700 dark:text-zinc-300">CV / Resume Terlampir</label>
                    <div class="p-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800/50 flex items-center justify-between gap-2">
                        <div class="flex items-center gap-2 min-w-0">
                            <svg class="w-4 h-4 text-[#1ca093] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <span class="font-medium truncate text-zinc-800 dark:text-zinc-200">CV_Budi_Pratama_Senior_Engineer.pdf</span>
                        </div>
                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold text-[11px] shrink-0">Siap Kirim</span>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block font-medium text-zinc-700 dark:text-zinc-300">Catatan Singkat untuk Recruiter (Opsional)</label>
                    <textarea 
                        rows="3" 
                        placeholder="Jelaskan secara singkat mengapa Anda cocok untuk posisi ini..." 
                        class="w-full rounded-xl border border-zinc-300 dark:border-zinc-700 p-3 bg-white dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 focus:border-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 dark:focus:border-[#1ca093] dark:focus:ring-[#1ca093]/25 outline-none"
                    ></textarea>
                </div>

                <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800 flex flex-col-reverse sm:flex-row justify-end gap-2.5">
                    <button 
                        type="button" 
                        @click="applyModalOpen = false" 
                        class="min-h-[44px] px-4 py-2 rounded-xl border border-zinc-300 text-xs font-medium dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 cursor-pointer"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit" 
                        :disabled="submitting" 
                        class="min-h-[44px] px-5 py-2.5 rounded-xl bg-[#1ca093] text-white font-semibold text-xs hover:bg-[#168579] active:bg-[#137267] disabled:opacity-50 shadow-sm shadow-[#1ca093]/20 cursor-pointer"
                    >
                        <span x-text="submitting ? 'Mengirim Lamaran...' : 'Konfirmasi & Kirim Lamaran'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
