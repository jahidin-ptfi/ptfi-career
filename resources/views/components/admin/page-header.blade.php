@props([
    'title',
    'description' => null,
    'breadcrumbs' => [],
])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        @if (!empty($breadcrumbs))
            <div class="mb-2">
                <x-ui.breadcrumb :items="$breadcrumbs" />
            </div>
        @endif
        <h1 class="text-2xl font-semibold tracking-tight text-zinc-900 dark:text-zinc-100">
            {{ $title }}
        </h1>
        @if ($description)
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                {{ $description }}
            </p>
        @endif
    </div>

    @if ($slot->isNotEmpty())
        <div class="flex items-center gap-3 shrink-0">
            {{ $slot }}
        </div>
    @endif
</div>
