@props([
    'name',
    'title' => null,
    'description' => null,
    'maxWidth' => 'md',
])

@php
    $maxWidthClasses = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
    ][$maxWidth] ?? 'sm:max-w-md';
@endphp

<!-- Wrapper: Menggunakan flex items-center justify-center agar SELALU di tengah layar -->
<div x-data="{ show: false, name: '{{ $name }}' }" x-show="show"
    x-on:open-modal.window="if ($event.detail === name) show = true"
    x-on:close-modal.window="if ($event.detail === name) show = false" x-on:keydown.escape.window="show = false"
    x-effect="document.body.classList.toggle('overflow-hidden', show)" x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6" role="dialog" aria-modal="true">

    <!-- Backdrop Blur -->
    <div x-show="show" x-transition.opacity
        class="fixed inset-0 bg-zinc-950/40 backdrop-blur-sm transition-opacity dark:bg-zinc-950/70"
        @click="show = false"></div>

    <!-- Modal Panel -->
    <div x-show="show" x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative w-full {{ $maxWidthClasses }} transform overflow-hidden rounded-2xl border border-zinc-200/80 bg-white shadow-2xl transition-all dark:border-zinc-800 dark:bg-zinc-900 max-h-[90vh] flex flex-col">

        <!-- Header (Hanya muncul jika ada title/description) -->
        @if ($title || $description)
            <div class="flex items-start justify-between p-5 pb-4 border-b border-zinc-100 dark:border-zinc-800 shrink-0">
                <div>
                    @if ($title)
                        <h3 class="text-base font-semibold leading-6 text-zinc-900 dark:text-zinc-100">
                            {{ $title }}
                        </h3>
                    @endif
                    @if ($description)
                        <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">
                            {{ $description }}
                        </p>
                    @endif
                </div>

                <!-- Close icon -->
                <button type="button" @click="show = false"
                    class="rounded-lg p-1 text-zinc-400 hover:bg-zinc-100 hover:text-zinc-500 dark:hover:bg-zinc-800 dark:hover:text-zinc-300 focus:outline-none transition-colors -mt-1 -mr-1">
                    <span class="sr-only">Close</span>
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <!-- Content Body (Bisa di-scroll jika kontennya sangat panjang) -->
        <div class="p-5 overflow-y-auto text-sm text-zinc-600 dark:text-zinc-300">
            {{ $slot }}
        </div>

        <!-- Footer Actions -->
        @if (isset($footer))
            <div
                class="px-5 py-4 bg-zinc-50/60 dark:bg-zinc-950/40 border-t border-zinc-100 dark:border-zinc-800 flex justify-end gap-3 shrink-0">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>