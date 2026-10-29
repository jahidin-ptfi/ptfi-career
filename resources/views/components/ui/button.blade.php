@props([
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'disabled' => false,
    'loading' => false,
    'icon' => null,
    'iconTrailing' => null,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none disabled:cursor-not-allowed select-none active:scale-[0.98]';

$variantClasses = [
    'primary' => 'bg-[#1ca093] text-white hover:bg-[#168579] active:bg-[#137267] focus-visible:ring-[#1ca093] shadow-xs border border-transparent dark:bg-[#1ca093] dark:hover:bg-[#168579]',
    'secondary' => 'bg-white text-zinc-800 border border-zinc-300 hover:bg-zinc-50 active:bg-zinc-100 focus-visible:ring-zinc-400 shadow-xs dark:bg-zinc-900 dark:text-zinc-200 dark:border-zinc-750 dark:hover:bg-zinc-800',
    'outline' => 'bg-transparent text-zinc-700 border border-zinc-300 hover:bg-zinc-100 active:bg-zinc-200 focus-visible:ring-zinc-400 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-800/80',
    'ghost' => 'bg-transparent text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 active:bg-zinc-200 focus-visible:ring-zinc-400 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 active:bg-red-800 focus-visible:ring-red-500 shadow-xs border border-transparent dark:bg-red-600 dark:hover:bg-red-500',
    'success' => 'bg-emerald-600 text-white hover:bg-emerald-700 active:bg-emerald-800 focus-visible:ring-emerald-500 shadow-xs border border-transparent dark:bg-emerald-600 dark:hover:bg-emerald-500',
    'link' => 'bg-transparent text-[#1ca093] hover:underline p-0 focus-visible:ring-[#1ca093] dark:text-[#2dd4bf]',
][$variant] ?? 'primary';

$sizeClasses = [
    'sm' => 'text-xs px-2.5 py-1.5 rounded-md gap-1.5',
    'md' => 'text-sm px-3.5 py-2 rounded-lg gap-2',
    'lg' => 'text-base px-4.5 py-2.5 rounded-lg gap-2.5',
][$size] ?? 'md';

$iconSizes = [
    'sm' => 'w-3.5 h-3.5',
    'md' => 'w-4 h-4',
    'lg' => 'w-5 h-5',
][$size] ?? 'w-4 h-4';

$classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($loading)
            <svg class="animate-spin {{ $iconSizes }} text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $disabled || $loading ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}>
        @if ($loading)
            <svg class="animate-spin {{ $iconSizes }} text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
