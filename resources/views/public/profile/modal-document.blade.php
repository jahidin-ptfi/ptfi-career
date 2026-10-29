<x-ui.modal name="document-modal" maxWidth="md">
    <form @submit.prevent="submitForm" class="space-y-4">
        <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100 border-b pb-2">Unggah Dokumen</h3>
        <div>
            <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Nama Dokumen</label>
            <input type="text" x-model="form.nama" required placeholder="Contoh: KTP, Ijazah, CV"
                class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
        </div>
        <div>
            <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">File
                (PDF/JPG/PNG)</label>
            <input type="file" @change="form.file = $event.target.files[0]" required accept=".pdf,.jpg,.jpeg,.png"
                class="block w-full text-xs text-zinc-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#1ca093]/10 file:text-[#1ca093] hover:file:bg-[#1ca093]/20 dark:text-zinc-400 dark:file:bg-[#1ca093]/20 dark:file:text-[#2dd4bf] cursor-pointer">
        </div>
        <div class="flex justify-end gap-2 pt-4">
            <button type="button" @click="$dispatch('close-modal', 'document-modal')"
                class="px-4 py-2 text-xs bg-zinc-100 rounded-lg">Batal</button>
            <button type="submit" :disabled="loading"
                class="px-4 py-2 text-xs bg-[#1ca093] text-white rounded-lg disabled:opacity-50"
                x-text="loading ? 'Mengunggah...' : 'Unggah'"></button>
        </div>
    </form>
</x-ui.modal>