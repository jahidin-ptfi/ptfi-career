<x-ui.modal name="course-modal" maxWidth="2xl">
    <form @submit.prevent="submitForm" class="space-y-5 text-left">
        <div class="flex items-center gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-3">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center text-white shadow-md shadow-purple-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100"
                    x-text="editId ? 'Edit Kursus' : 'Tambah Kursus'"></h3>
                <p class="text-xs text-zinc-500">Lengkapi riwayat kursus dan pelatihan Anda.</p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Nama Kursus /
                    Pelatihan</label>
                <input type="text" x-model="form.nama" required placeholder="Contoh: Fullstack Web Dev"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Lembaga</label>
                    <input type="text" x-model="form.lembaga" required placeholder="Contoh: Udemy"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Dibiayai
                        Oleh</label>
                    <input type="text" x-model="form.dibiayai_oleh" required placeholder="Mandiri / Perusahaan"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tahun
                        Mulai</label>
                    <input type="text" x-model="form.periode_awal" required x-init="
                            let fp = flatpickr($el, {
                                dateFormat: 'Y',
                                plugins: [window.yearSelectPlugin({ dateFormat: 'Y', altFormat: 'Y' })],
                                onChange: (dates, str) => {
                                    $el.value = str;
                                    $el.dispatchEvent(new Event('input'));
                                }
                            });
                            $watch('form.periode_awal', value => {
                                if (!fp) return;
                                if (value) {
                                    let year = parseInt(value, 10);
                                    if (!isNaN(year)) {
                                        let d = new Date(year, 0, 1);
                                        fp.setDate(d, false);
                                        fp.jumpToDate(d);
                                        $el.value = String(year);
                                    }
                                } else {
                                    fp.clear();
                                    $el.value = '';
                                }
                            });
                        " placeholder="Pilih Tahun"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tahun
                        Selesai</label>
                    <input type="text" x-model="form.periode_akhir" required x-init="
                            let fp = flatpickr($el, {
                                dateFormat: 'Y',
                                plugins: [window.yearSelectPlugin({ dateFormat: 'Y', altFormat: 'Y' })],
                                onChange: (dates, str) => {
                                    $el.value = str;
                                    $el.dispatchEvent(new Event('input'));
                                }
                            });
                            $watch('form.periode_akhir', value => {
                                if (!fp) return;
                                if (value) {
                                    let year = parseInt(value, 10);
                                    if (!isNaN(year)) {
                                        let d = new Date(year, 0, 1);
                                        fp.setDate(d, false);
                                        fp.jumpToDate(d);
                                        $el.value = String(year);
                                    }
                                } else {
                                    fp.clear();
                                    $el.value = '';
                                }
                            });
                        " placeholder="Pilih Tahun"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
            <button type="button" @click="$dispatch('close-modal', 'course-modal')"
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