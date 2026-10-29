@props([
    'align' => 'right',
    'width' => 'w-48',
])

@php
$alignmentClasses = [
    'left' => 'left-0 origin-top-left',
    'right' => 'right-0 origin-top-right',
][$align] ?? 'right-0 origin-top-right';
@endphp

<div 
    x-data="{ open: false }" 
    @keydown.escape.stop="open = false" 
    @click.outside="open = false" 
    class="relative inline-block text-left"
>
    <!-- Trigger Button -->
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <!-- Dropdown Menu -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-1.5 {{ $width }} {{ $alignmentClasses }} rounded-lg border border-zinc-200/80 bg-white p-1 text-zinc-800 shadow-lg ring-1 ring-black/5 focus:outline-none dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-200 dark:ring-white/10"
        style="display: none;"
    >
        {{ $content ?? $slot }}
    </div>
</div>
