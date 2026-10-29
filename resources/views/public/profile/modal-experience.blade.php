<x-ui.modal name="experience-modal" maxWidth="2xl">
    <form @submit.prevent="submitForm" class="space-y-5 text-left">
        <div class="flex items-center gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-3">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-md shadow-blue-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100"
                    x-text="editId ? 'Edit Pengalaman' : 'Tambah Pengalaman'"></h3>
                <p class="text-xs text-zinc-500">Lengkapi riwayat pekerjaan profesional Anda.</p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label
                        class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Perusahaan</label>
                    <input type="text" x-model="form.perusahaan" required placeholder="PT Contoh Jaya"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Jabatan</label>
                    <input type="text" x-model="form.jabatan" required placeholder="Software Engineer"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tgl Masuk</label>
                    <input type="text" x-model="form.tgl_masuk" required
                        x-init="$nextTick(() => { flatpickr($el, { dateFormat: 'Y-m-d', defaultDate: $el.value, onChange: (dates, str) => { $el.value = str; $el.dispatchEvent(new Event('input')); } }) })"
                        placeholder="YYYY-MM-DD"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tgl
                        Keluar</label>
                    <input type="text" x-model="form.tgl_keluar" required
                        x-init="$nextTick(() => { flatpickr($el, { dateFormat: 'Y-m-d', defaultDate: $el.value, onChange: (dates, str) => { $el.value = str; $el.dispatchEvent(new Event('input')); } }) })"
                        placeholder="YYYY-MM-DD"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Gaji (Angka)</label>
                <input type="number" x-model="form.gaji" required placeholder="5000000"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Deskripsi
                    Pekerjaan</label>
                <textarea x-model="form.deskripsi" rows="3" placeholder="Jelaskan tanggung jawab Anda..."
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors"></textarea>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
            <button type="button" @click="$dispatch('close-modal', 'experience-modal')"
                class="px-5 py-2.5 text-xs font-semibold text-zinc-600 bg-zinc-100 hover:bg-zinc-200 rounded-xl dark:bg-zinc-800 dark:text-zinc-300 transition-colors">Batal</button>
            <button type="submit" :disabled="loading"
                class="px-5 py-2.5 text-xs font-semibold text-white bg-gradient-to-r from-[#1ca093] to-[#168579] hover:from-[#168579] hover:to-[#137267] rounded-xl shadow-md shadow-[#1ca093]/30 disabled:opacity-50 transition-all active:scale-95 flex items-center gap-2">
                <svg x-show="loading" class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span x-text="loading ? 'Menyimpan...' : 'Simpan Data'"></span>
            </button>
        </div>
    </form>
</x-ui.modal>