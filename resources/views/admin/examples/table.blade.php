@extends('layouts.admin', ['title' => 'Komponen Data Table Enterprise — Flux UI'])

@section('content')
<div class="max-w-6xl space-y-8" x-data="{
    search: '',
    department: 'all',
    selectedItems: [],
    items: [
        { id: 101, title: 'Lisensi SaaS Enterprise', client: 'PT Telekomunikasi Utama', amount: 'Rp 45.000.000', status: 'paid', date: '25 Okt 2026' },
        { id: 102, title: 'Setup Cloud Infrastructure', client: 'Bank Mandiri Digital', amount: 'Rp 88.500.000', status: 'pending', date: '24 Okt 2026' },
        { id: 103, title: 'Konsultasi Keamanan Siber', client: 'Fintech Nusantara', amount: 'Rp 22.000.000', status: 'paid', date: '23 Okt 2026' },
        { id: 104, title: 'Maintenance & SLA Q4', client: 'Logistik Cepat Tbk', amount: 'Rp 14.200.000', status: 'overdue', date: '18 Okt 2026' },
        { id: 105, title: 'Kustomisasi Modul Keuangan', client: 'Retail Sejahtera', amount: 'Rp 36.000.000', status: 'paid', date: '15 Okt 2026' }
    ],
    toggleAll() {
        if (this.selectedItems.length === this.items.length) {
            this.selectedItems = [];
        } else {
            this.selectedItems = this.items.map(i => i.id);
        }
    }
}">
    <x-admin.page-header 
        title="Data Table Showcase" 
        description="Pola implementasi tabel data profesional dengan toolbar pencarian, filter status, checkbox baris, aksi massal, dan dropdown menu per baris."
        :breadcrumbs="['Contoh UI' => null, 'Data Table' => null]"
    />

    <!-- Table Component Demonstration -->
    <div class="rounded-xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900 overflow-hidden">
        <!-- Table Toolbar -->
        <div class="p-4 border-b border-zinc-100 dark:border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <input
                    type="text"
                    x-model="search"
                    placeholder="Cari transaksi atau klien..."
                    class="rounded-lg border border-zinc-200 bg-white px-3 py-1.5 text-xs text-zinc-900 placeholder-zinc-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-100 w-full sm:w-64"
                />
            </div>

            <!-- Bulk actions indicator -->
            <div class="flex items-center gap-2">
                <div x-show="selectedItems.length > 0" class="text-xs text-blue-600 dark:text-blue-400 font-medium">
                    <span x-text="selectedItems.length + ' transaksi terpilih'"></span>
                </div>
                <x-ui.button variant="secondary" size="sm">Unduh Data</x-ui.button>
                <x-ui.button size="sm">Buat Transaksi Baru</x-ui.button>
            </div>
        </div>

        <!-- Table Body -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="border-b border-zinc-200/80 bg-zinc-50/75 dark:border-zinc-800 dark:bg-zinc-900/50 text-zinc-500 dark:text-zinc-400 font-medium select-none">
                        <th class="w-10 px-4 py-3">
                            <input
                                type="checkbox"
                                @change="toggleAll()"
                                :checked="selectedItems.length === items.length && items.length > 0"
                                class="h-4 w-4 rounded border-zinc-300 text-blue-600 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800"
                            />
                        </th>
                        <th class="px-4 py-3 font-semibold">ID & Item Layanan</th>
                        <th class="px-4 py-3 font-semibold">Nama Klien</th>
                        <th class="px-4 py-3 font-semibold">Nominal Transaksi</th>
                        <th class="px-4 py-3 font-semibold">Status Pembayaran</th>
                        <th class="px-4 py-3 font-semibold">Tanggal</th>
                        <th class="w-16 px-4 py-3 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100 dark:divide-zinc-800/80 text-zinc-700 dark:text-zinc-300">
                    <template x-for="item in items" :key="item.id">
                        <tr class="hover:bg-zinc-50/80 dark:hover:bg-zinc-800/40 transition-colors">
                            <td class="px-4 py-3.5">
                                <input
                                    type="checkbox"
                                    :value="item.id"
                                    x-model="selectedItems"
                                    class="h-4 w-4 rounded border-zinc-300 text-blue-600 focus:ring-blue-500/20 dark:border-zinc-700 dark:bg-zinc-800"
                                />
                            </td>
                            <td class="px-4 py-3.5">
                                <div class="font-medium text-zinc-900 dark:text-zinc-100" x-text="item.title"></div>
                                <span class="text-[10px] text-zinc-400 font-mono" x-text="'#INV-' + item.id"></span>
                            </td>
                            <td class="px-4 py-3.5 font-medium" x-text="item.client"></td>
                            <td class="px-4 py-3.5 font-semibold text-zinc-900 dark:text-zinc-100" x-text="item.amount"></td>
                            <td class="px-4 py-3.5">
                                <template x-if="item.status === 'paid'">
                                    <x-ui.badge variant="success" dot="true">Lunas</x-ui.badge>
                                </template>
                                <template x-if="item.status === 'pending'">
                                    <x-ui.badge variant="warning" dot="true">Menunggu</x-ui.badge>
                                </template>
                                <template x-if="item.status === 'overdue'">
                                    <x-ui.badge variant="danger" dot="true">Jatuh Tempo</x-ui.badge>
                                </template>
                            </td>
                            <td class="px-4 py-3.5 text-zinc-500 text-[11px]" x-text="item.date"></td>
                            <td class="px-4 py-3.5 text-right">
                                <x-ui.dropdown align="right" width="w-36">
                                    <x-slot:trigger>
                                        <button class="p-1 rounded text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                    </x-slot:trigger>
                                    <div class="py-1">
                                        <button @click="$store.toasts.add({ title: 'Invoice', message: 'Membuka faktur ' + item.id, type: 'info' })" class="w-full text-left px-3 py-1.5 text-xs text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">Detail Invoice</button>
                                        <button @click="$store.toasts.add({ title: 'Duplikat', message: 'Invoice diduplikasi.', type: 'info' })" class="w-full text-left px-3 py-1.5 text-xs text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800">Duplikat</button>
                                    </div>
                                </x-ui.dropdown>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Compact Pagination -->
        <div class="border-t border-zinc-100 dark:border-zinc-800 p-2 sm:px-4">
            <x-ui.pagination :currentPage="1" :totalPages="5" :totalRecords="25" :perPage="5" />
        </div>
    </div>
</div>
@endsection
