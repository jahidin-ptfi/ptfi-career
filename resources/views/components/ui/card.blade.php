@props([
    'title' => null,
    'description' => null,
    'headerActions' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-xl border border-zinc-200/80 bg-white shadow-2xs dark:border-zinc-800 dark:bg-zinc-900 transition-colors']) }}>
    @if ($title || $description || $headerActions)
        <div class="px-5 py-4 border-b border-zinc-100 dark:border-zinc-800/80 flex items-center justify-between gap-4">
            <div>
                @if ($title)
                    <h3 class="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ $title }}
                    </h3>
                @endif
                @if ($description)
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if ($headerActions)
                <div class="flex items-center gap-2">
                    {{ $headerActions }}
                </div>
            @endif
        </div>
    @endif

    <div class="p-5">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="px-5 py-3 border-t border-zinc-100 dark:border-zinc-800/80 bg-zinc-50/50 dark:bg-zinc-900/50 rounded-b-xl flex items-center justify-between">
            {{ $footer }}
        </div>
    @endif
</div>
