@props([
    'variant' => 'neutral',
    'size' => 'md',
    'dot' => false,
])

@php
$variants = [
    'neutral' => 'bg-zinc-100 text-zinc-800 border-zinc-200 dark:bg-zinc-800/80 dark:text-zinc-300 dark:border-zinc-700',
    'primary' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-950/60 dark:text-blue-300 dark:border-blue-900',
    'success' => 'bg-emerald-50 text-emerald-700 border-emerald-200 dark:bg-emerald-950/60 dark:text-emerald-300 dark:border-emerald-900',
    'warning' => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-950/60 dark:text-amber-300 dark:border-amber-900',
    'danger' => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-950/60 dark:text-red-300 dark:border-red-900',
    'purple' => 'bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-950/60 dark:text-purple-300 dark:border-purple-900',
][$variant] ?? 'neutral';

$dotColors = [
    'neutral' => 'bg-zinc-400 dark:bg-zinc-500',
    'primary' => 'bg-blue-500 dark:bg-blue-400',
    'success' => 'bg-emerald-500 dark:bg-emerald-400',
    'warning' => 'bg-amber-500 dark:bg-amber-400',
    'danger' => 'bg-red-500 dark:bg-red-400',
    'purple' => 'bg-purple-500 dark:bg-purple-400',
][$variant] ?? 'bg-zinc-400';

$sizes = [
    'sm' => 'text-[11px] px-2 py-0.5 gap-1 font-medium',
    'md' => 'text-xs px-2.5 py-0.5 gap-1.5 font-medium',
][$size] ?? 'md';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-md border {$variants} {$sizes} tracking-wide select-none"]) }}>
    @if ($dot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColors }}"></span>
    @endif
    {{ $slot }}
</span>
