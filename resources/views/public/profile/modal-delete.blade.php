<x-ui.modal name="delete-modal" maxWidth="sm">
    <div class="text-center space-y-5 p-2">
        <!-- Ikon Peringatan Modern -->
        <div
            class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-red-100 to-red-200 dark:from-red-950/50 dark:to-red-900/30 mb-2 ring-4 ring-white dark:ring-zinc-900">
            <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div>

        <div>
            <h3 class="text-xl font-bold text-zinc-900 dark:text-zinc-100">Hapus Data Ini?</h3>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">
                Data yang telah dihapus <span class="font-semibold text-red-500">tidak dapat dikembalikan</span>. Apakah
                Anda yakin ingin melanjutkan?
            </p>
        </div>

        <div class="flex justify-center gap-3 pt-4 border-t border-zinc-100 dark:border-zinc-800 w-full">
            <button type="button" @click="$dispatch('close-modal', 'delete-modal')"
                class="px-5 py-2.5 text-sm font-semibold text-zinc-600 bg-zinc-100 hover:bg-zinc-200 rounded-xl dark:bg-zinc-800 dark:text-zinc-300 transition-colors">
                Batal
            </button>
            <button type="button" @click="executeDelete()" :disabled="deleteLoading"
                class="px-5 py-2.5 text-sm font-semibold text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-xl shadow-md shadow-red-500/30 disabled:opacity-50 transition-all active:scale-95 flex items-center gap-2">
                <svg x-show="deleteLoading" class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span x-text="deleteLoading ? 'Menghapus...' : 'Ya, Hapus Data'"></span>
            </button>
        </div>
    </div>
</x-ui.modal>