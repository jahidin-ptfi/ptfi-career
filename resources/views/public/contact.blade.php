@extends('layouts.public', ['title' => 'Kontak & Dukungan — FluxBlade UI'])

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
    <div class="text-center max-w-2xl mx-auto mb-12">
        <x-ui.badge variant="primary">Hubungi Kami</x-ui.badge>
        <h1 class="mt-3 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white sm:text-4xl">
            Kami siap mendengar masukan Anda
        </h1>
        <p class="mt-3 text-sm text-zinc-600 dark:text-zinc-400">
            Punya pertanyaan mengenai implementasi Blade atau membutuhkan kustomisasi komponen? Kirimkan pesan melalui form di bawah ini.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Contact Info Card -->
        <div class="p-6 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 space-y-6">
            <h3 class="text-base font-semibold text-zinc-900 dark:text-white">Informasi Kontak</h3>
            
            <div class="space-y-4 text-xs text-zinc-600 dark:text-zinc-400">
                <div class="flex items-start gap-3">
                    <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <div>
                        <div class="font-medium text-zinc-900 dark:text-zinc-100">Email Tim Dukungan</div>
                        <div>support@fluxblade.internal</div>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <div>
                        <div class="font-medium text-zinc-900 dark:text-zinc-100">Lokasi Kantor</div>
                        <div>Sudirman Central Business District (SCBD), Jakarta Selatan</div>
                    </div>
                </div>

                <div class="flex items-start gap-3">
                    <svg class="w-4 h-4 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <div class="font-medium text-zinc-900 dark:text-zinc-100">Jam Operasional</div>
                        <div>Senin — Jumat, 09.00 - 18.00 WIB</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form (Frontend only, with Alpine state) -->
        <div 
            x-data="{ 
                submitting: false, 
                submitted: false,
                submitForm() {
                    this.submitting = true;
                    setTimeout(() => {
                        this.submitting = false;
                        this.submitted = true;
                        $store.toasts.add({ title: 'Pesan Terkirim', message: 'Terima kasih! Tim kami akan membalas pesan Anda dalam 24 jam.', type: 'success' });
                    }, 1000);
                }
            }"
            class="md:col-span-2 p-6 sm:p-8 rounded-2xl border border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 shadow-2xs"
        >
            <div x-show="submitted" class="p-6 text-center space-y-3" style="display: none;">
                <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 dark:bg-emerald-950 dark:text-emerald-400 mx-auto flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Pesan Berhasil Terkirim!</h3>
                <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-sm mx-auto">
                    Data form frontend telah divalidasi. Pada integrasi Laravel asli, ini diproses oleh Controller backend Anda.
                </p>
                <x-ui.button @click="submitted = false" variant="secondary" size="sm">
                    Kirim Pesan Lain
                </x-ui.button>
            </div>

            <form x-show="!submitted" @submit.prevent="submitForm()" method="POST" action="{{ route('contact.send') ?? '#' }}" class="space-y-4">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.input
                        name="name"
                        label="Nama Lengkap"
                        placeholder="Contoh: Budi Pratama"
                        required="true"
                    />

                    <x-ui.input
                        name="email"
                        type="email"
                        label="Alamat Email"
                        placeholder="nama@perusahaan.com"
                        required="true"
                    />
                </div>

                <x-ui.input
                    name="subject"
                    label="Subjek Pesan"
                    placeholder="Pertanyaan seputar lisensi atau integrasi"
                    required="true"
                />

                <x-ui.textarea
                    name="message"
                    label="Isi Pesan"
                    rows="4"
                    placeholder="Tuliskan detail pertanyaan atau kebutuhan Anda di sini..."
                    required="true"
                />

                <div class="pt-2 flex items-center justify-between">
                    <span class="text-xs text-zinc-400 dark:text-zinc-500">* Wajib diisi</span>
                    <x-ui.button type="submit" size="md" ::loading="submitting">
                        Kirim Pesan Sekarang
                    </x-ui.button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
