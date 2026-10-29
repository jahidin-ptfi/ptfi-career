<x-ui.modal name="family-modal" maxWidth="2xl">
    <form @submit.prevent="submitForm" class="space-y-5 text-left">
        <div class="flex items-center gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-3">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white shadow-md shadow-emerald-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100"
                    x-text="editId ? 'Edit Keluarga' : 'Tambah Keluarga'"></h3>
                <p class="text-xs text-zinc-500">Data anggota keluarga inti.</p>
            </div>
        </div>

        <div class="space-y-4">
            <div x-show="!editId">
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tipe Keluarga</label>
                <select x-model="form.tipe"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    <option value="1">Keluarga I (Orang Tua / Saudara)</option>
                    <option value="2">Keluarga II (Suami / Istri / Anak)</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Nama
                        Lengkap</label>
                    <input type="text" x-model="form.nama" required placeholder="Nama Anggota Keluarga"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Hubungan</label>
                    <select x-model="form.hubungan" required
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                        <option value="">-- Pilih Hubungan --</option>
                        @foreach(\App\Enums\HubunganKeluarga::options() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Jenis
                        Kelamin</label>
                    <select x-model="form.jenis_kelamin" required
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                        <option value="laki-laki">Laki-laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tempat
                        Lahir</label>
                    <input type="text" x-model="form.tempat_lahir" required placeholder="Kota Kelahiran"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tanggal Lahir</label>
                <!-- 👇 Menggunakan Flatpickr Standar dengan $watch untuk sinkronisasi Edit 👇 -->
                <input type="text" x-model="form.tgl_lahir" required x-init="
                        let fp = flatpickr($el, {
                            dateFormat: 'Y-m-d',
                            onChange: (dates, str) => {
                                $el.value = str;
                                $el.dispatchEvent(new Event('input'));
                            }
                        });
                        $watch('form.tgl_lahir', value => {
                            if (!fp) return;
                            if (value) {
                                let d = new Date(value);
                                if (!isNaN(d.getTime())) {
                                    fp.setDate(d, false);
                                    fp.jumpToDate(d);
                                    $el.value = value;
                                }
                            } else {
                                fp.clear();
                                $el.value = '';
                            }
                        });
                    " placeholder="YYYY-MM-DD"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
            <button type="button" @click="$dispatch('close-modal', 'family-modal')"
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