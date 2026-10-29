@props([
    'src' => null,
    'alt' => 'Avatar',
    'initials' => null,
    'size' => 'md',
    'status' => null, // 'online', 'offline', 'busy'
])

@php
$sizeClasses = [
    'xs' => 'w-6 h-6 text-xs',
    'sm' => 'w-8 h-8 text-xs',
    'md' => 'w-9 h-9 text-sm',
    'lg' => 'w-11 h-11 text-base',
    'xl' => 'w-14 h-14 text-lg',
][$size] ?? 'w-9 h-9 text-sm';

$statusDotSize = [
    'xs' => 'w-1.5 h-1.5',
    'sm' => 'w-2 h-2',
    'md' => 'w-2.5 h-2.5',
    'lg' => 'w-3 h-3',
    'xl' => 'w-3.5 h-3.5',
][$size] ?? 'w-2.5 h-2.5';

$statusColors = [
    'online' => 'bg-emerald-500 ring-white dark:ring-zinc-900',
    'busy' => 'bg-red-500 ring-white dark:ring-zinc-900',
    'offline' => 'bg-zinc-400 ring-white dark:ring-zinc-900',
][$status] ?? null;
@endphp

<div class="relative inline-flex shrink-0">
    @if ($src)
        <img 
            src="{{ $src }}" 
            alt="{{ $alt }}" 
            {{ $attributes->merge(['class' => "rounded-full object-cover border border-zinc-200/80 dark:border-zinc-700/80 {$sizeClasses}"]) }}
        />
    @else
        <div {{ $attributes->merge(['class' => "inline-flex items-center justify-center font-medium rounded-full bg-zinc-100 text-zinc-700 border border-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:border-zinc-700 select-none {$sizeClasses}"]) }}>
            {{ $initials ?? strtoupper(substr($alt, 0, 2)) }}
        </div>
    @endif

    @if ($status && $statusColors)
        <span class="absolute bottom-0 right-0 block rounded-full ring-2 {{ $statusDotSize }} {{ $statusColors }}"></span>
    @endif
</div>
