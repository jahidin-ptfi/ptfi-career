<x-ui.modal name="contact-modal" maxWidth="2xl">
    <form @submit.prevent="submitForm" class="space-y-5 text-left">
        <div class="flex items-center gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-3">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center text-white shadow-md shadow-rose-500/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100"
                    x-text="editId ? 'Edit Kontak Darurat' : 'Tambah Kontak Darurat'"></h3>
                <p class="text-xs text-zinc-500">Orang yang dapat dihubungi dalam keadaan darurat.</p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Nama
                        Lengkap</label>
                    <input type="text" x-model="form.nama" required placeholder="Nama Kontak"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>

                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Hubungan</label>
                    <select x-model="form.hubungan" required
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                        <option value="">-- Pilih Hubungan --</option>
                        <!-- 👇 Otomatis dari Enum 👇 -->
                        @foreach(\App\Enums\HubunganKeluarga::options() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Alamat</label>
                <input type="text" x-model="form.alamat" required placeholder="Alamat lengkap kontak"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">No. Telepon /
                    HP</label>
                <input type="text" x-model="form.kontak" required placeholder="0812xxxxxx"
                    class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
            </div>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800">
            <button type="button" @click="$dispatch('close-modal', 'contact-modal')"
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