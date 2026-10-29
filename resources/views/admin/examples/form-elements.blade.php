@extends('layouts.admin', ['title' => 'Koleksi Form Elements — Flux UI Style'])

@section('content')
<div class="max-w-4xl space-y-8" x-data="{
    uploadedFiles: [],
    handleDrop(e) {
        const files = Array.from(e.dataTransfer.files);
        this.addFiles(files);
    },
    handleSelect(e) {
        const files = Array.from(e.target.files);
        this.addFiles(files);
    },
    addFiles(files) {
        files.forEach(f => {
            this.uploadedFiles.push({
                name: f.name,
                size: (f.size / 1024).toFixed(1) + ' KB',
                type: f.type
            });
        });
        $store.toasts.add({ title: 'File Terpilih', message: files.length + ' file siap diunggah ke form.', type: 'info' });
    },
    removeFile(index) {
        this.uploadedFiles.splice(index, 1);
    }
}">
    <x-admin.page-header 
        title="Form Elements Showcase" 
        description="Dokumentasi lengkap komponen input form bergaya Flux UI dengan label, helper text, visual validation, dan drag-and-drop file upload."
        :breadcrumbs="['Contoh UI' => null, 'Form Elements' => null]"
    />

    <!-- Text & Standard Inputs -->
    <x-ui.card title="Standard Inputs" description="Tipe input standar dengan berbagai variasi state">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Normal Text -->
            <x-ui.input
                name="demo_text"
                label="Text Input"
                placeholder="Masukkan teks biasa..."
                helper="Helper text singkat untuk panduan pengguna"
            />

            <!-- Required Input with prefix -->
            <x-ui.input
                name="demo_prefix"
                label="Input dengan Prefix Ikon"
                placeholder="cari data..."
                prefix="🔍"
                required="true"
            />

            <!-- Email Input -->
            <x-ui.input
                name="demo_email"
                type="email"
                label="Email Input"
                placeholder="pengguna@domain.com"
            />

            <!-- Number Input with suffix -->
            <x-ui.input
                name="demo_number"
                type="number"
                label="Nominal Jumlah"
                placeholder="100"
                suffix="unit"
            />

            <!-- Date Input -->
            <x-ui.input
                name="demo_date"
                type="date"
                label="Pilih Tanggal"
                value="{{ date('Y-m-d') }}"
            />

            <!-- Validation Error State Demo -->
            <x-ui.input
                name="demo_error"
                label="Input dengan Pesan Error"
                value="nilai-tidak-valid"
                error="Format input tidak sesuai dengan aturan yang ditentukan."
            />

            <!-- Disabled State -->
            <x-ui.input
                name="demo_disabled"
                label="Input Terkunci (Disabled)"
                value="Tidak dapat diubah"
                disabled="true"
            />

            <!-- Readonly State -->
            <x-ui.input
                name="demo_readonly"
                label="Input Hanya Baca (Readonly)"
                value="ID: USR-984210"
                readonly="true"
            />
        </div>
    </x-ui.card>

    <!-- Textarea & Selects -->
    <x-ui.card title="Textarea & Dropdown Select" description="Area teks multibaris dan pilihan opsi">
        <div class="space-y-5">
            <x-ui.textarea
                name="demo_textarea"
                label="Catatan & Deskripsi Tambahan"
                rows="3"
                placeholder="Tuliskan keterangan detail di sini..."
                helper="Maksimal 500 karakter"
            />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <x-ui.select
                    name="demo_select"
                    label="Kategori Pilihan (Select)"
                    placeholder="-- Pilih Salah Satu Kategori --"
                    :options="[
                        'tech' => 'Teknologi & Informasi',
                        'health' => 'Kesehatan & Medis',
                        'finance' => 'Keuangan & Akuntansi'
                    ]"
                />

                <x-ui.select
                    name="demo_select_error"
                    label="Select dengan Error State"
                    error="Harap pilih departemen yang valid sebelum melanjutkan."
                    :options="['' => 'Belum dipilih']"
                />
            </div>
        </div>
    </x-ui.card>

    <!-- Selection Controls: Checkbox, Radio, Switch -->
    <x-ui.card title="Selection Controls" description="Kontrol pilihan checkbox, radio buttons, dan switch toggle">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Checkboxes -->
            <div class="space-y-3">
                <h4 class="text-xs font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-2">Checkboxes</h4>
                <x-ui.checkbox name="check1" label="Langganan Newsletter" checked="true" />
                <x-ui.checkbox name="check2" label="Setujui Syarat & Ketentuan" description="Wajib dicentang sebelum submit" />
                <x-ui.checkbox name="check3" label="Opsi Nonaktif (Disabled)" disabled="true" />
            </div>

            <!-- Radio Buttons -->
            <div class="space-y-3">
                <h4 class="text-xs font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-2">Radio Group</h4>
                <x-ui.radio name="role_demo" value="admin" label="Super Administrator" checked="true" />
                <x-ui.radio name="role_demo" value="staff" label="Staff Operasional" />
                <x-ui.radio name="role_demo" value="viewer" label="Read-Only Viewer" />
            </div>

            <!-- Toggle Switches -->
            <div class="space-y-4">
                <h4 class="text-xs font-semibold text-zinc-900 dark:text-zinc-100 uppercase tracking-wider mb-2">Switch Toggles</h4>
                <x-ui.switch name="sw1" label="Autentikasi 2FA" description="Verifikasi OTP email" checked="true" />
                <x-ui.switch name="sw2" label="Mode Maintenance" description="Tutup akses publik sementara" />
            </div>
        </div>
    </x-ui.card>

    <!-- Modern File Upload (Drag & Drop + Preview) -->
    <x-ui.card title="File Upload (Drag and Drop)" description="Area interaktif pengunggahan dokumen dan gambar pada sisi frontend">
        <div class="space-y-4">
            <!-- Dropzone -->
            <div 
                @dragover.prevent
                @drop.prevent="handleDrop($event)"
                class="border-2 border-dashed border-zinc-300 dark:border-zinc-700 hover:border-blue-500 dark:hover:border-blue-400 rounded-xl p-8 text-center transition-colors cursor-pointer bg-zinc-50/50 dark:bg-zinc-900/40"
                @click="$refs.fileInput.click()"
            >
                <input 
                    type="file" 
                    x-ref="fileInput" 
                    @change="handleSelect($event)" 
                    class="hidden" 
                    multiple 
                />

                <div class="mx-auto w-12 h-12 rounded-full bg-blue-50 text-blue-600 dark:bg-blue-950 dark:text-blue-400 flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>

                <p class="text-xs font-medium text-zinc-700 dark:text-zinc-300">
                    <span class="text-blue-600 dark:text-blue-400 font-semibold underline">Klik untuk memilih file</span> atau seret dokumen ke sini
                </p>
                <p class="text-[11px] text-zinc-400 dark:text-zinc-500 mt-1">
                    Mendukung format PNG, JPG, PDF, atau DOCX (Maksimal 10MB per file)
                </p>
            </div>

            <!-- Uploaded Files List -->
            <div x-show="uploadedFiles.length > 0" class="space-y-2" style="display: none;">
                <h5 class="text-xs font-semibold text-zinc-800 dark:text-zinc-200">File yang dipilih:</h5>
                <template x-for="(file, idx) in uploadedFiles" :key="idx">
                    <div class="flex items-center justify-between p-3 rounded-lg border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-xs">
                        <div class="flex items-center gap-2 overflow-hidden">
                            <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <span class="font-medium text-zinc-800 dark:text-zinc-200 truncate" x-text="file.name"></span>
                            <span class="text-zinc-400 dark:text-zinc-500" x-text="'(' + file.size + ')'"></span>
                        </div>
                        <button 
                            type="button" 
                            @click="removeFile(idx)"
                            class="text-red-500 hover:text-red-700 p-1 text-xs font-semibold"
                        >
                            Hapus
                        </button>
                    </div>
                </template>
            </div>
        </div>
    </x-ui.card>
</div>
@endsection
