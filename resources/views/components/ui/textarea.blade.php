@props([
    'name',
    'label' => null,
    'id' => null,
    'rows' => 4,
    'value' => null,
    'placeholder' => null,
    'helper' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
])

@php
$id = $id ?? $name;
$hasError = !empty($error);
@endphp

<div class="space-y-1.5 w-full">
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ $label }}
            @if ($required)
                <span class="text-red-500 ml-0.5">*</span>
            @endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $id }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        {{ $readonly ? 'readonly' : '' }}
        {{ $attributes->merge([
            'class' => 'w-full rounded-lg border text-sm transition-colors duration-150 p-3 shadow-2xs ' .
                ($hasError
                    ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-500/20 dark:border-red-800 dark:text-red-200 dark:placeholder-red-500 dark:focus:ring-red-500/20'
                    : 'border-zinc-300 bg-white text-zinc-900 placeholder-zinc-400 hover:border-zinc-400 focus:border-[#1ca093] focus:outline-none focus:ring-2 focus:ring-[#1ca093]/20 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-100 dark:placeholder-zinc-500 dark:hover:border-zinc-600 dark:focus:border-[#1ca093] dark:focus:ring-[#1ca093]/25') .
                ($disabled ? ' bg-zinc-50 text-zinc-400 cursor-not-allowed dark:bg-zinc-800/50 dark:text-zinc-500' : '')
        ]) }}
    >{{ $value ?? $slot }}</textarea>

    @if ($hasError)
        <p class="text-xs text-red-600 dark:text-red-400 flex items-center gap-1 mt-1">
            <svg class="w-3.5 h-3.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span>{{ $error }}</span>
        </p>
    @elseif ($helper)
        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">{{ $helper }}</p>
    @endif
</div>
