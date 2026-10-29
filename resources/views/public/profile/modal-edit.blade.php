<x-ui.modal name="edit-modal" maxWidth="3xl">
    <form @submit.prevent="submitEdit()" x-data="{ editTab: 'basic' }" class="text-left flex flex-col max-h-[85vh]">

        <!-- Header -->
        <div class="flex items-center gap-3 border-b border-zinc-100 dark:border-zinc-800 pb-3 mb-4 shrink-0">
            <div
                class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#1ca093] to-[#168579] flex items-center justify-center text-white shadow-md shadow-[#1ca093]/20">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold text-zinc-900 dark:text-zinc-100">Edit Profil Utama</h3>
                <p class="text-xs text-zinc-500">Perbarui data diri, alamat, dan kontak Anda.</p>
            </div>
        </div>

        <!-- Error Alert -->
        <template x-if="editError">
            <div
                class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-xs text-red-700 dark:border-red-900/60 dark:bg-red-950/40 dark:text-red-300 shrink-0">
                <span class="font-semibold">Gagal menyimpan:</span> <span x-text="editError"></span>
            </div>
        </template>

        <!-- Tab Navigation -->
        <div
            class="flex items-center gap-1 rounded-xl border border-zinc-200 bg-zinc-100/70 p-1 dark:border-zinc-800 dark:bg-zinc-900/60 mb-5 overflow-x-auto shrink-0">
            <button type="button" @click="editTab = 'basic'"
                :class="editTab === 'basic' ? 'bg-white text-[#1ca093] shadow-sm dark:bg-zinc-800 dark:text-[#2dd4bf]' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors whitespace-nowrap">
                <i class="ti ti-user text-sm"></i>
                <span>Dasar</span>
            </button>
            <button type="button" @click="editTab = 'detail'"
                :class="editTab === 'detail' ? 'bg-white text-[#1ca093] shadow-sm dark:bg-zinc-800 dark:text-[#2dd4bf]' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors whitespace-nowrap">
                <i class="ti ti-info-circle text-sm"></i>
                <span>Detail</span>
            </button>
            <button type="button" @click="editTab = 'alamat'"
                :class="editTab === 'alamat' ? 'bg-white text-[#1ca093] shadow-sm dark:bg-zinc-800 dark:text-[#2dd4bf]' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors whitespace-nowrap">
                <i class="ti ti-map-pin text-sm"></i>
                <span>Alamat</span>
            </button>
            <button type="button" @click="editTab = 'sosmed'"
                :class="editTab === 'sosmed' ? 'bg-white text-[#1ca093] shadow-sm dark:bg-zinc-800 dark:text-[#2dd4bf]' : 'text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-200'"
                class="flex-1 inline-flex items-center justify-center gap-1.5 rounded-lg px-3 py-2 text-xs font-semibold transition-colors whitespace-nowrap">
                <i class="ti ti-share text-sm"></i>
                <span>Sosmed</span>
            </button>
        </div>

        <!-- Content Area (Scrollable) -->
        <div class="overflow-y-auto p-1 space-y-4 flex-1 pb-40">

            <!-- ============== TAB: BASIC ============== -->
            <div x-show="editTab === 'basic'" x-cloak class="space-y-4">
                <div
                    class="p-4 rounded-xl border border-zinc-200 bg-zinc-50/50 dark:border-zinc-700 dark:bg-zinc-800/30">
                    <label class="block text-xs font-semibold mb-3 text-zinc-700 dark:text-zinc-300">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-20 h-20 rounded-xl overflow-hidden bg-[#e7f6f3] dark:bg-[#1ca093]/20 flex items-center justify-center shrink-0 border border-zinc-200 dark:border-zinc-700">
                            <template x-if="editFotoPreview">
                                <img :src="editFotoPreview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!editFotoPreview">
                                <svg class="w-8 h-8 text-[#1ca093] dark:text-[#2dd4bf]" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </template>
                        </div>
                        <div class="flex-1">
                            <input type="file" name="foto" @change="handleEditFile" accept="image/jpeg,image/png"
                                class="block w-full text-xs text-zinc-500 file:mr-2 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-[#1ca093]/10 file:text-[#1ca093] hover:file:bg-[#1ca093]/20 dark:text-zinc-400 dark:file:bg-[#1ca093]/20 dark:file:text-[#2dd4bf] cursor-pointer">
                            <p class="mt-1.5 text-[10px] text-zinc-400">Format: JPG/PNG. Maks: 512KB.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Nama Lengkap
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" x-model="editForm.nama"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">NIK (No.
                            KTP)</label>
                        <input type="text" name="no_ktp" x-model="editForm.no_ktp"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Jenis Kelamin
                            <span class="text-red-500">*</span></label>
                        <select name="jenis_kelamin" x-model="editForm.jenis_kelamin"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tempat Lahir
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="tempat_lahir" x-model="editForm.tempat_lahir"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Tanggal Lahir
                            <span class="text-red-500">*</span></label>
                        <input type="text" name="tgl_lahir" x-model="editForm.tgl_lahir"
                            x-init="$nextTick(() => { flatpickr($el, { dateFormat: 'Y-m-d', defaultDate: $el.value, onChange: (dates, str) => { $el.value = str; $el.dispatchEvent(new Event('input')); } }) })"
                            placeholder="YYYY-MM-DD"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    </div>
                </div>
            </div>

            <!-- ============== TAB: DETAIL ============== -->
            <div x-show="editTab === 'detail'" x-cloak class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Agama</label>
                        <select name="agama" x-model="editForm.agama"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                            <option value="">-- Pilih Agama --</option>
                            @foreach(\App\Enums\Agama::options() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Golongan
                            Darah</label>
                        <select name="gol_darah" x-model="editForm.gol_darah"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                            <option value="">-- Pilih Golongan Darah --</option>
                            @foreach(\App\Enums\GolonganDarah::options() as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Status
                        Pernikahan</label>
                    <select name="status_pernikahan" x-model="editForm.status_pernikahan"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                        <option value="">-- Pilih Status --</option>
                        @foreach(\App\Enums\StatusPernikahan::options() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">No. HP /
                            WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="selular" x-model="editForm.selular"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Telepon
                            Rumah</label>
                        <input type="text" name="telepon" x-model="editForm.telepon"
                            class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                    </div>
                </div>
            </div>

            <!-- ============== TAB: ALAMAT ============== -->
            <div x-show="editTab === 'alamat'" x-cloak class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Provinsi -->
                    <div class="relative z-40" x-data="{ open: false, search: '' }" @click.away="open = false">
                        <label
                            class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Provinsi</label>
                        <button type="button" @click="open = !open; if(open) $nextTick(() => $refs.searchInput.focus())"
                            class="w-full flex items-center justify-between rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors text-left shadow-sm">
                            <span class="truncate text-zinc-700 dark:text-zinc-300"
                                x-text="editForm.provinsi_id ? (provinsiOptions.find(p => p.kode == editForm.provinsi_id)?.nama || 'Pilih Provinsi') : 'Pilih Provinsi'"></span>
                            <svg class="w-4 h-4 text-zinc-400 shrink-0 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <input type="hidden" name="provinsi_id" x-model="editForm.provinsi_id">
                        <div x-show="open" x-transition
                            class="absolute z-[100] w-full mt-1 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-60 overflow-y-auto">
                            <div
                                class="p-2 sticky top-0 bg-white dark:bg-zinc-800 border-b border-zinc-100 dark:border-zinc-700 z-10">
                                <input type="text" x-ref="searchInput" x-model="search" placeholder="Cari provinsi..."
                                    class="w-full text-xs rounded-lg border border-zinc-300 bg-zinc-50 px-3 py-1.5 focus:border-[#1ca093] focus:outline-none dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100">
                            </div>
                            <ul class="py-1 text-xs">
                                <template
                                    x-for="p in provinsiOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase()))"
                                    :key="p.kode">

                                    <li @click="editForm.provinsi_id = p.kode; open = false; search = ''; fetchKota(p.kode, true)"
                                        class="px-4 py-2 hover:bg-[#e7f6f3] dark:hover:bg-[#1ca093]/20 cursor-pointer transition-colors"
                                        :class="editForm.provinsi_id == p.kode ? 'bg-[#e7f6f3] text-[#168579] font-semibold dark:bg-[#1ca093]/20 dark:text-[#2dd4bf]' : 'text-zinc-700 dark:text-zinc-300'"
                                        x-text="p.nama"></li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Kota/Kabupaten -->
                    <div class="relative z-30" x-data="{ open: false, search: '' }" @click.away="open = false">
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Kota /
                            Kabupaten</label>
                        <button type="button" @click="open = !open; if(open) $nextTick(() => $refs.searchInput.focus())"
                            class="w-full flex items-center justify-between rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors text-left shadow-sm">
                            <span class="truncate text-zinc-700 dark:text-zinc-300"
                                x-text="editForm.kota_id ? (kotaOptions.find(p => p.kode == editForm.kota_id)?.nama || 'Pilih Kota/Kab') : 'Pilih Kota/Kab'"></span>
                            <svg class="w-4 h-4 text-zinc-400 shrink-0 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <input type="hidden" name="kota_id" x-model="editForm.kota_id">
                        <div x-show="open" x-transition
                            class="absolute z-[100] w-full mt-1 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-60 overflow-y-auto">
                            <div
                                class="p-2 sticky top-0 bg-white dark:bg-zinc-800 border-b border-zinc-100 dark:border-zinc-700 z-10">
                                <input type="text" x-ref="searchInput" x-model="search" placeholder="Cari kota..."
                                    class="w-full text-xs rounded-lg border border-zinc-300 bg-zinc-50 px-3 py-1.5 focus:border-[#1ca093] focus:outline-none dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100">
                            </div>
                            <ul class="py-1 text-xs">
                                <template
                                    x-for="k in kotaOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase()))"
                                    :key="k.kode">

                                    <li @click="editForm.kota_id = k.kode; open = false; search = ''; fetchKecamatan(k.kode, true)"
                                        class="px-4 py-2 hover:bg-[#e7f6f3] dark:hover:bg-[#1ca093]/20 cursor-pointer transition-colors"
                                        :class="editForm.kota_id == k.kode ? 'bg-[#e7f6f3] text-[#168579] font-semibold dark:bg-[#1ca093]/20 dark:text-[#2dd4bf]' : 'text-zinc-700 dark:text-zinc-300'"
                                        x-text="k.nama"></li>
                                </template>
                                <template
                                    x-if="kotaOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase())).length === 0">
                                    <li class="px-4 py-3 text-center text-zinc-500 italic">Tidak ditemukan / Pilih
                                        Provinsi dulu</li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Kecamatan -->
                    <div class="relative z-20" x-data="{ open: false, search: '' }" @click.away="open = false">
                        <label
                            class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Kecamatan</label>
                        <button type="button" @click="open = !open; if(open) $nextTick(() => $refs.searchInput.focus())"
                            class="w-full flex items-center justify-between rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors text-left shadow-sm">
                            <span class="truncate text-zinc-700 dark:text-zinc-300"
                                x-text="editForm.kecamatan_id ? (kecamatanOptions.find(p => p.kode == editForm.kecamatan_id)?.nama || 'Pilih Kecamatan') : 'Pilih Kecamatan'"></span>
                            <svg class="w-4 h-4 text-zinc-400 shrink-0 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <input type="hidden" name="kecamatan_id" x-model="editForm.kecamatan_id">
                        <div x-show="open" x-transition
                            class="absolute z-[100] w-full mt-1 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-60 overflow-y-auto">
                            <div
                                class="p-2 sticky top-0 bg-white dark:bg-zinc-800 border-b border-zinc-100 dark:border-zinc-700 z-10">
                                <input type="text" x-ref="searchInput" x-model="search" placeholder="Cari kecamatan..."
                                    class="w-full text-xs rounded-lg border border-zinc-300 bg-zinc-50 px-3 py-1.5 focus:border-[#1ca093] focus:outline-none dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100">
                            </div>
                            <ul class="py-1 text-xs">
                                <template
                                    x-for="k in kecamatanOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase()))"
                                    :key="k.kode">

                                    <li @click="editForm.kecamatan_id = k.kode; open = false; search = ''; fetchKelurahan(k.kode)"
                                        class="px-4 py-2 hover:bg-[#e7f6f3] dark:hover:bg-[#1ca093]/20 cursor-pointer transition-colors"
                                        :class="editForm.kecamatan_id == k.kode ? 'bg-[#e7f6f3] text-[#168579] font-semibold dark:bg-[#1ca093]/20 dark:text-[#2dd4bf]' : 'text-zinc-700 dark:text-zinc-300'"
                                        x-text="k.nama"></li>
                                </template>
                                <template
                                    x-if="kecamatanOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase())).length === 0">
                                    <li class="px-4 py-3 text-center text-zinc-500 italic">Tidak ditemukan / Pilih Kota
                                        dulu</li>
                                </template>
                            </ul>
                        </div>
                    </div>

                    <!-- Kelurahan/Desa -->
                    <div class="relative z-10" x-data="{ open: false, search: '' }" @click.away="open = false">
                        <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Kelurahan /
                            Desa</label>
                        <button type="button" @click="open = !open; if(open) $nextTick(() => $refs.searchInput.focus())"
                            class="w-full flex items-center justify-between rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors text-left shadow-sm">
                            <span class="truncate text-zinc-700 dark:text-zinc-300"
                                x-text="editForm.kelurahan_id ? (kelurahanOptions.find(p => p.kode == editForm.kelurahan_id)?.nama || 'Pilih Kelurahan') : 'Pilih Kelurahan'"></span>
                            <svg class="w-4 h-4 text-zinc-400 shrink-0 ml-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <input type="hidden" name="kelurahan_id" x-model="editForm.kelurahan_id">
                        <div x-show="open" x-transition
                            class="absolute z-[100] w-full mt-1 bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-xl max-h-60 overflow-y-auto">
                            <div
                                class="p-2 sticky top-0 bg-white dark:bg-zinc-800 border-b border-zinc-100 dark:border-zinc-700 z-10">
                                <input type="text" x-ref="searchInput" x-model="search" placeholder="Cari kelurahan..."
                                    class="w-full text-xs rounded-lg border border-zinc-300 bg-zinc-50 px-3 py-1.5 focus:border-[#1ca093] focus:outline-none dark:border-zinc-600 dark:bg-zinc-900 dark:text-zinc-100">
                            </div>
                            <ul class="py-1 text-xs">
                                <template
                                    x-for="k in kelurahanOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase()))"
                                    :key="k.kode">

                                    <li @click="editForm.kelurahan_id = k.kode; open = false; search = ''"
                                        class="px-4 py-2 hover:bg-[#e7f6f3] dark:hover:bg-[#1ca093]/20 cursor-pointer transition-colors"
                                        :class="editForm.kelurahan_id == k.kode ? 'bg-[#e7f6f3] text-[#168579] font-semibold dark:bg-[#1ca093]/20 dark:text-[#2dd4bf]' : 'text-zinc-700 dark:text-zinc-300'"
                                        x-text="k.nama"></li>
                                </template>
                                <template
                                    x-if="kelurahanOptions.filter(opt => opt.nama.toLowerCase().includes(search.toLowerCase())).length === 0">
                                    <li class="px-4 py-3 text-center text-zinc-500 italic">Tidak ditemukan / Pilih
                                        Kecamatan dulu</li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="mt-7">
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Alamat Lengkap
                        <span class="text-red-500">*</span></label>
                    <textarea name="alamat" x-model="editForm.alamat" rows="3"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors"></textarea>
                </div>
            </div>

            <!-- ============== TAB: SOSMED ============== -->
            <div x-show="editTab === 'sosmed'" x-cloak class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Facebook</label>
                    <input type="text" name="facebook" x-model="editForm.facebook"
                        placeholder="@username atau link profil"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">Instagram</label>
                    <input type="text" name="instagram" x-model="editForm.instagram"
                        placeholder="@username atau link profil"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
                <div>
                    <label class="block text-xs font-semibold mb-1.5 text-zinc-700 dark:text-zinc-300">TikTok</label>
                    <input type="text" name="tiktok" x-model="editForm.tiktok" placeholder="@username atau link profil"
                        class="w-full rounded-xl border border-zinc-200 bg-zinc-50 px-4 py-2.5 text-sm focus:border-[#1ca093] focus:bg-white focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-800 dark:focus:bg-zinc-900 transition-colors">
                </div>
            </div>
        </div>

        <!-- Footer Actions -->
        <div class="flex justify-between items-center pt-4 border-t border-zinc-100 dark:border-zinc-800 shrink-0">
            <div class="text-[11px] text-zinc-400">
                Step <span x-text="['basic', 'detail', 'alamat', 'sosmed'].indexOf(editTab) + 1"></span> / 4
            </div>

            <div class="flex gap-3">
                <button type="button" @click="$dispatch('close-modal', 'edit-modal')"
                    class="px-5 py-2.5 text-xs font-semibold text-zinc-600 bg-zinc-100 hover:bg-zinc-200 rounded-xl dark:bg-zinc-800 dark:text-zinc-300 transition-colors">Batal</button>
                <button type="submit" :disabled="editLoading"
                    class="px-5 py-2.5 text-xs font-semibold text-white bg-gradient-to-r from-[#1ca093] to-[#168579] hover:from-[#168579] hover:to-[#137267] rounded-xl shadow-md shadow-[#1ca093]/30 disabled:opacity-50 transition-all active:scale-95 flex items-center gap-2">
                    <svg x-show="editLoading" class="animate-spin h-3.5 w-3.5 text-white" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span x-text="editLoading ? 'Menyimpan...' : 'Simpan Perubahan'"></span>
                </button>
            </div>
        </div>
    </form>
</x-ui.modal>