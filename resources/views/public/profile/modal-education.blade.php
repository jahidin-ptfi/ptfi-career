<x-ui.modal name="education-modal" maxWidth="2xl">
    <form @submit.prevent="submitForm" class="space-y-5 text-left">
        <!-- Header Modern -->
        <div class="flex items-center gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-3">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#1ca093] to-[#168579] flex items-center justify-center text-white shadow-md shadow-[#1ca093]/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100"
                    x-text="editId ? 'Edit Pendidikan' : 'Tambah Pendidikan'"></h3>
                <p class="text-xs text-zinc-500">Lengkapi riwayat pendidikan formal Anda.</p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tingkat
                    Pendidikan</label>
                <select x-model="form.tingkat" required
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    @foreach(\App\Enums\TingkatPendidikan::options() as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Nama
                    Institusi</label>
                <input type="text" x-model="form.nama" required placeholder="Contoh: Universitas Indonesia"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Jurusan</label>
                <input type="text" x-model="form.jurusan" required placeholder="Contoh: Teknik Informatika"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tahun
                        Masuk</label>
                    <!-- 👇 Flatpickr dengan jumpToDate 👇 -->
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
                        Lulus</label>
                    <!-- 👇 Flatpickr dengan jumpToDate 👇 -->
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
            <button type="button" @click="$dispatch('close-modal', 'education-modal')"
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