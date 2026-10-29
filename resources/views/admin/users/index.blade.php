@extends('layouts.admin', ['title' => 'Manajemen Pengguna'])

@section('content')
<div 
    x-data="{ 
        search: '',
        statusFilter: 'all',
        selectedUsers: [],
        deleteModalOpen: false,
        userToDelete: null,
        users: [
            { id: 1, name: 'Budi Pratama', email: 'budi.pratama@example.com', role: 'Super Admin', status: 'active', department: 'Engineering', created_at: '24 Okt 2026' },
            { id: 2, name: 'Rina Susanti', email: 'rina.s@example.com', role: 'Product Manager', status: 'active', department: 'Product', created_at: '22 Okt 2026' },
            { id: 3, name: 'Ahmad Fauzi', email: 'ahmad.f@example.com', role: 'Staff Developer', status: 'inactive', department: 'Engineering', created_at: '19 Okt 2026' },
            { id: 4, name: 'Dewi Lestari', email: 'dewi.lestari@example.com', role: 'UI/UX Designer', status: 'active', department: 'Design', created_at: '15 Okt 2026' },
            { id: 5, name: 'Hendro Gunawan', email: 'hendro.g@example.com', role: 'Quality Assurance', status: 'pending', department: 'QA', created_at: '12 Okt 2026' },
            { id: 6, name: 'Siti Rahmawati', email: 'siti.rahma@example.com', role: 'Finance Officer', status: 'active', department: 'Finance', created_at: '08 Okt 2026' }
        ],
        toggleSelectAll() {
            if (this.selectedUsers.length === this.filteredUsers().length) {
                this.selectedUsers = [];
            } else {
                this.selectedUsers = this.filteredUsers().map(u => u.id);
            }
        },
        filteredUsers() {
            return this.users.filter(u => {
                const matchSearch = u.name.toLowerCase().includes(this.search.toLowerCase()) || 
                                    u.email.toLowerCase().includes(this.search.toLowerCase());
                const matchStatus = this.statusFilter === 'all' || u.status === this.statusFilter;
                return matchSearch && matchStatus;
            });
        },
        confirmDelete(user) {
            this.userToDelete = user;
            this.deleteModalOpen = true;
        },
        executeDelete() {
            this.users = this.users.filter(u => u.id !== this.userToDelete.id);
            this.deleteModalOpen = false;
            $store.toasts.add({ title: 'Pengguna Dihapus', message: 'Data pengguna telah berhasil dihapus dari sistem.', type: 'success' });
        }
    }"
>
    <!-- Page Header -->
    <x-admin.page-header 
        title="Daftar Pengguna" 
        description="Kelola akun tim, hak akses pengguna, dan pantau status akun aktif dalam sistem."
        :breadcrumbs="['Pengguna' => null]"
    >
        <div class="flex items-center gap-2">
            <x-ui.button variant="secondary" size="sm">
                <svg class="w-4 h-4 mr-1.5 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Ekspor CSV</span>
            </x-ui.button>

            <x-ui.button href="{{ route('admin.users.create') ?? '/admin/users/create' }}" size="sm">
                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah Pengguna</span>
            </x-ui.button>
        </div>
    </x-admin.page-header>

    <!-- Table Container Card -->
    <div class="rounded-xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900 overflow-hidden">
        <!-- Table Toolbar -->
        <div class="p-4 border-b border-zinc-100 dark:border-zinc-800/80 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <div class="flex flex-1 items-center gap-2 max-w-md">
                <!-- Search input -->
                <div class="relative w-full">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-zinc-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        x-model="search"
                        placeholder="Cari nama atau email..."
                        class="w-full rounded-lg border border-zinc-200 bg-white pl-9 pr-3 py-1.5 text-xs text-zinc-900 placeholder-zinc-400 hover:border-zinc-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800/60 dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:bg-zinc-900 transition-colors"
                    />
                </div>

                <!-- Status Filter Dropdown -->
                <select
                    x-model="statusFilter"
                    class="rounded-lg border border-zinc-200 bg-white px-3 py-1.5 text-xs text-zinc-700 hover:border-zinc-300 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-200"
                >
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                    <option value="pending">Menunggu</option>
                </select>
            </div>

            <!-- Bulk Action Bar when items selected -->
            <div x-show="selectedUsers.length > 0" class="flex items-center gap-2 text-xs bg-blue-50 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 px-3 py-1.5 rounded-lg border border-blue-200 dark:border-blue-900">
                <span class="font-medium" x-text="selectedUsers.length + ' terpilih'"></span>
                <button 
                    @click="selectedUsers = []; $store.toasts.add({ title: 'Tindakan Massal', message: 'Pengguna terpilih telah diarsipkan.', type: 'info' })" 
                    class="font-semibold underline ml-1 hover:text-blue-900 dark:hover:text-white"
                >
                    Arsipkan Terpilih
                </button>
            </div>
        </div>

        <!-- Data Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-zinc-200/80 bg-zinc-50/75 dark:border-zinc-800 dark:bg-zinc-900/50 text-zinc-500 dark:text-zinc-400 font-medium select-none">
                        <th class="w-10 px-4 py-3">
                            <input
                                type="checkbox"
                                @change="toggleSelectAll()"
                                :checked="selectedUsers.length === filteredUsers().length && filteredUsers().length > 0"
                                class="h-4 w-4 rounded border-zinc-300 text-blue-600 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800"
                            />
                        </th>
                        <th class="px-4 py-3 font-semibold">Pengguna</th>
                        <th class="px-4 py-3 font-semibold">Departemen</th>
                        <th class="px-4 py-3 font-semibold">Peran / Role</th>
                        <th class="px-4 py-3 font-semibold">Status Akun</th>
                        <th class="px-4 py-3 font-semibold">Bergabung</th>
                        <th class="w-16 px-4 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800/80 text-zinc-700 dark:text-zinc-300">
                    <template x-for="user in filteredUsers()" :key="user.id">
                        <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition-colors">
                            <td class="px-4 py-3.5">
                                <input
                                    type="checkbox"
                                    :value="user.id"
                                    x-model="selectedUsers"
                                    class="h-4 w-4 rounded border-zinc-300 text-blue-600 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800"
                                />
                            </td>
                            <!-- Avatar & Name -->
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    <x-ui.avatar size="sm" ::initials="user.name.split(' ').map(n=>n[0]).join('')" />
                                    <div>
                                        <a :href="'/admin/users/' + user.id" class="font-medium text-zinc-900 dark:text-zinc-100 hover:text-blue-600 dark:hover:text-blue-400" x-text="user.name"></a>
                                        <p class="text-[11px] text-zinc-400 dark:text-zinc-500" x-text="user.email"></p>
                                    </div>
                                </div>
                            </td>
                            <!-- Department -->
                            <td class="px-4 py-3.5 text-zinc-600 dark:text-zinc-400" x-text="user.department"></td>
                            <!-- Role -->
                            <td class="px-4 py-3.5 font-medium text-zinc-800 dark:text-zinc-200" x-text="user.role"></td>
                            <!-- Status -->
                            <td class="px-4 py-3.5">
                                <template x-if="user.status === 'active'">
                                    <x-ui.badge variant="success" dot="true">Aktif</x-ui.badge>
                                </template>
                                <template x-if="user.status === 'inactive'">
                                    <x-ui.badge variant="neutral" dot="true">Nonaktif</x-ui.badge>
                                </template>
                                <template x-if="user.status === 'pending'">
                                    <x-ui.badge variant="warning" dot="true">Menunggu</x-ui.badge>
                                </template>
                            </td>
                            <!-- Created At -->
                            <td class="px-4 py-3.5 text-zinc-500 dark:text-zinc-400 text-[11px]" x-text="user.created_at"></td>
                            <!-- Row Action Dropdown (Flux Pattern) -->
                            <td class="px-4 py-3.5 text-right">
                                <x-ui.dropdown align="right" width="w-40">
                                    <x-slot:trigger>
                                        <button
                                            type="button"
                                            class="p-1 rounded-md text-zinc-400 hover:bg-zinc-100 hover:text-zinc-700 dark:hover:bg-zinc-800 dark:hover:text-zinc-200 transition-colors"
                                            aria-label="Aksi baris"
                                        >
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                    </x-slot:trigger>

                                    <div class="py-1">
                                        <a :href="'/admin/users/' + user.id" class="flex items-center gap-2 px-3 py-1.5 text-xs text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800 rounded-md">
                                            <span>Lihat Detail</span>
                                        </a>
                                        <a :href="'/admin/users/' + user.id + '/edit'" class="flex items-center gap-2 px-3 py-1.5 text-xs text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800 rounded-md">
                                            <span>Edit Akun</span>
                                        </a>
                                        <button 
                                            type="button" 
                                            @click="confirmDelete(user)"
                                            class="w-full text-left flex items-center gap-2 px-3 py-1.5 text-xs text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/40 rounded-md"
                                        >
                                            <span>Hapus Akun</span>
                                        </button>
                                    </div>
                                </x-ui.dropdown>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Empty State if no records match -->
        <template x-if="filteredUsers().length === 0">
            <div class="p-8">
                <x-ui.empty-state
                    title="Tidak ada pengguna ditemukan"
                    description="Sesuaikan kata kunci pencarian atau ubah filter status di bagian toolbar atas."
                >
                    <x-ui.button @click="search = ''; statusFilter = 'all'" size="sm" variant="secondary">
                        Reset Filter Pencarian
                    </x-ui.button>
                </x-ui.empty-state>
            </div>
        </template>

        <!-- Compact Pagination Footer -->
        <div class="border-t border-zinc-100 dark:border-zinc-800 p-2 sm:px-4">
            <x-ui.pagination :currentPage="1" :totalPages="8" :totalRecords="76" :perPage="10" />
        </div>
    </div>

    <!-- Confirmation Modal for Delete -->
    <div 
        x-show="deleteModalOpen" 
        class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
        style="display: none;"
    >
        <div class="fixed inset-0 bg-zinc-950/40 backdrop-blur-xs" @click="deleteModalOpen = false"></div>
        <div class="relative mx-auto my-12 w-full sm:max-w-md rounded-xl border border-zinc-200 bg-white p-6 shadow-xl dark:border-zinc-800 dark:bg-zinc-900">
            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 dark:bg-red-950 dark:text-red-400 flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">Konfirmasi Penghapusan</h3>
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                        Apakah Anda yakin ingin menghapus akun <span class="font-semibold text-zinc-900 dark:text-zinc-200" x-text="userToDelete?.name"></span>? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <x-ui.button type="button" variant="secondary" size="sm" @click="deleteModalOpen = false">
                    Batal
                </x-ui.button>
                <x-ui.button type="button" variant="danger" size="sm" @click="executeDelete()">
                    Ya, Hapus Akun
                </x-ui.button>
            </div>
        </div>
    </div>
</div>
@endsection
