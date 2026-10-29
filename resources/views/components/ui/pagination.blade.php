@props([
    'currentPage' => 1,
    'totalPages' => 10,
    'totalRecords' => 124,
    'perPage' => 10,
])

@php
// Generate compact pagination window (e.g. 1 2 3 ... 10 or 1 ... 5 6 7 ... 20)
$pages = [];
if ($totalPages <= 7) {
    $pages = range(1, $totalPages);
} else {
    if ($currentPage <= 3) {
        $pages = [1, 2, 3, 4, '...', $totalPages];
    } elseif ($currentPage >= $totalPages - 2) {
        $pages = [1, '...', $totalPages - 3, $totalPages - 2, $totalPages - 1, $totalPages];
    } else {
        $pages = [1, '...', $currentPage - 1, $currentPage, $currentPage + 1, '...', $totalPages];
    }
}

$startRecord = ($currentPage - 1) * $perPage + 1;
$endRecord = min($currentPage * $perPage, $totalRecords);
@endphp

<div class="flex flex-col sm:flex-row items-center justify-between gap-4 py-3 px-1 text-sm text-zinc-600 dark:text-zinc-400">
    <div class="text-xs">
        Menampilkan <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $startRecord }}</span> sampai <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $endRecord }}</span> dari <span class="font-medium text-zinc-900 dark:text-zinc-100">{{ $totalRecords }}</span> entri
    </div>

    <div class="inline-flex items-center gap-1">
        <!-- Previous Button -->
        <button
            type="button"
            {{ $currentPage <= 1 ? 'disabled' : '' }}
            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg border border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 disabled:opacity-40 disabled:cursor-not-allowed dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 transition-colors"
        >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span>Sebelumnya</span>
        </button>

        <!-- Page Numbers -->
        <div class="flex items-center gap-1">
            @foreach ($pages as $p)
                @if ($p === '...')
                    <span class="px-2 py-1 text-xs text-zinc-400 select-none">...</span>
                @else
                    <button
                        type="button"
                        class="w-8 h-8 flex items-center justify-center text-xs font-medium rounded-lg border transition-colors {{ $p == $currentPage ? 'border-blue-600 bg-blue-600 text-white dark:bg-blue-600' : 'border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800' }}"
                    >
                        {{ $p }}
                    </button>
                @endif
            @endforeach
        </div>

        <!-- Next Button -->
        <button
            type="button"
            {{ $currentPage >= $totalPages ? 'disabled' : '' }}
            class="inline-flex items-center gap-1 px-2.5 py-1.5 text-xs font-medium rounded-lg border border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50 disabled:opacity-40 disabled:cursor-not-allowed dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 transition-colors"
        >
            <span>Selanjutnya</span>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>
    </div>
</div>
