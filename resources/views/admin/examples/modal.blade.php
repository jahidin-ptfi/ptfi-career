@extends('layouts.admin', ['title' => 'Komponen Modals & Dialogs — Flux UI'])

@section('content')
<div class="max-w-4xl space-y-8">
    <x-admin.page-header 
        title="Modals & Dialogs Showcase" 
        description="Beragam variasi modal dialog dengan animasi halus Alpine.js, backdrop blur, keyboard ESC close, dan fokus yang ramah aksesibilitas."
        :breadcrumbs="['Contoh UI' => null, 'Modals' => null]"
    />

    <x-ui.card title="Pilihan Variasi Dialog Modal" description="Klik tombol di bawah ini untuk menguji interaksi modal">
        <div class="flex flex-wrap gap-3">
            <!-- Modal 1: Standard Confirmation -->
            <x-ui.button @click="$dispatch('open-modal', 'standard-modal')">
                Modal Standar (Konfirmasi)
            </x-ui.button>

            <!-- Modal 2: Destructive Action Modal -->
            <x-ui.button variant="danger" @click="$dispatch('open-modal', 'destructive-modal')">
                Modal Destruktif (Hapus Data)
            </x-ui.button>

            <!-- Modal 3: Form Modal -->
            <x-ui.button variant="secondary" @click="$dispatch('open-modal', 'form-modal')">
                Modal dengan Form Isian
            </x-ui.button>

            <!-- Modal 4: Large Modal -->
            <x-ui.button variant="outline" @click="$dispatch('open-modal', 'large-modal')">
                Modal Ukuran Lebar (Large)
            </x-ui.button>
        </div>
    </x-ui.card>

    <!-- Modal 1: Standard -->
    <x-ui.modal 
        name="standard-modal" 
        title="Publikasikan Perubahan Sistem?" 
        description="Perubahan ini akan langsung berdampak pada seluruh pengguna aktif saat ini."
    >
        <p class="text-xs text-zinc-600 dark:text-zinc-400 leading-relaxed">
            Sistem telah memvalidasi seluruh berkas migrasi dan konfigurasi cache. Anda dapat membatalkan atau melanjutkan proses deployment.
        </p>

        <x-slot:footer>
            <x-ui.button variant="secondary" size="sm" @click="$dispatch('close-modal', 'standard-modal')">
                Batal
            </x-ui.button>
            <x-ui.button size="sm" @click="$dispatch('close-modal', 'standard-modal'); $store.toasts.add({ title: 'Dipublikasikan', message: 'Pembaruan telah berhasil diterapkan.', type: 'success' })">
                Ya, Publikasikan
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <!-- Modal 2: Destructive -->
    <x-ui.modal 
        name="destructive-modal" 
        title="Hapus Proyek Secara Permanen" 
        description="Tindakan ini bersifat destruktif dan data tidak dapat dipulihkan."
    >
        <div class="rounded-lg bg-red-50 p-3 text-xs text-red-700 dark:bg-red-950/40 dark:text-red-300 border border-red-200 dark:border-red-900 mb-3">
            Peringatan: Seluruh basis data, aset lampiran, dan riwayat audit proyek ini akan dihapus dari server cloud.
        </div>

        <x-slot:footer>
            <x-ui.button variant="secondary" size="sm" @click="$dispatch('close-modal', 'destructive-modal')">
                Batalkan
            </x-ui.button>
            <x-ui.button variant="danger" size="sm" @click="$dispatch('close-modal', 'destructive-modal'); $store.toasts.add({ title: 'Proyek Dihapus', message: 'Data telah dibersihkan secara permanen.', type: 'error' })">
                Hapus Selamanya
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <!-- Modal 3: Form Modal -->
    <x-ui.modal 
        name="form-modal" 
        title="Buat Kategori Baru" 
        description="Isi form singkat untuk membuat kategori baru"
    >
        <form class="space-y-4" @submit.prevent="$dispatch('close-modal', 'form-modal'); $store.toasts.add({ title: 'Kategori Dibuat', message: 'Kategori baru berhasil disimpan.', type: 'success' })">
            <x-ui.input name="category_name" label="Nama Kategori" placeholder="Contoh: Finansial & Pajak" required="true" />
            <x-ui.textarea name="category_desc" label="Deskripsi Singkat" rows="3" placeholder="Jelaskan cakupan kategori..." />

            <div class="flex justify-end gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                <x-ui.button type="button" variant="secondary" size="sm" @click="$dispatch('close-modal', 'form-modal')">
                    Batal
                </x-ui.button>
                <x-ui.button type="submit" size="sm">
                    Simpan Kategori
                </x-ui.button>
            </div>
        </form>
    </x-ui.modal>

    <!-- Modal 4: Large Modal -->
    <x-ui.modal 
        name="large-modal" 
        title="Pratinjau Dokumen Kontrak Perjanjian" 
        description="Dokumen hukum resmi PT Flux Enterprise Global"
        maxWidth="2xl"
    >
        <div class="space-y-3 text-xs text-zinc-600 dark:text-zinc-400 max-h-64 overflow-y-auto p-3 border border-zinc-200 dark:border-zinc-800 rounded-lg">
            <p class="font-semibold text-zinc-900 dark:text-zinc-100">Pasal 1 — Ketentuan Penggunaan Antarmuka</p>
            <p>Pengguna sistem berhak memanfaatkan antarmuka Blade ini untuk pengembangan perangkat lunak sesuai standar enterprise. Seluruh komponen didesain untuk menjamin privasi data dan ketersediaan sistem.</p>
            <p class="font-semibold text-zinc-900 dark:text-zinc-100">Pasal 2 — SLA dan Keandalan</p>
            <p>Layanan backend bertanggung jawab atas pengelolaan database dan integritas enkripsi sandi pengguna.</p>
        </div>

        <x-slot:footer>
            <x-ui.button variant="secondary" size="sm" @click="$dispatch('close-modal', 'large-modal')">
                Tutup
            </x-ui.button>
            <x-ui.button size="sm" @click="$dispatch('close-modal', 'large-modal'); $store.toasts.add({ title: 'Disetujui', message: 'Dokumen kontrak telah ditandatangani secara digital.', type: 'success' })">
                Setujui Dokumen
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
</div>
@endsection
