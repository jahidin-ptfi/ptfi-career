@props([
    'title' => 'Tidak ada data ditemukan',
    'description' => 'Mulai dengan menambahkan data pertama atau sesuaikan filter pencarian Anda.',
    'icon' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center py-12 px-4 text-center rounded-xl border border-dashed border-zinc-300 dark:border-zinc-800 bg-white/50 dark:bg-zinc-900/40']) }}>
    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-zinc-100 text-zinc-500 dark:bg-zinc-800 dark:text-zinc-400 mb-4">
        @if ($icon)
            {{ $icon }}
        @else
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
        @endif
    </div>

    <h3 class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
        {{ $title }}
    </h3>

    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400 max-w-sm">
        {{ $description }}
    </p>

    @if ($slot->isNotEmpty())
        <div class="mt-5">
            {{ $slot }}
        </div>
    @endif
</div>
