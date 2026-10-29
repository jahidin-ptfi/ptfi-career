@props([
    'name',
    'id' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
    'value' => '1',
    'disabled' => false,
    'error' => null,
])

@php
$id = $id ?? $name;
@endphp

<div class="flex items-start">
    <div class="flex h-5 items-center">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $id }}"
            value="{{ $value }}"
            {{ $checked ? 'checked' : '' }}
            {{ $disabled ? 'disabled' : '' }}
            {{ $attributes->merge([
                'class' => 'h-4 w-4 rounded border-zinc-300 text-[#1ca093] focus:ring-2 focus:ring-[#1ca093]/20 focus:ring-offset-0 transition-colors dark:border-zinc-700 dark:bg-zinc-900 dark:checked:bg-[#1ca093] dark:focus:ring-[#1ca093]/25 disabled:opacity-50 disabled:cursor-not-allowed'
            ]) }}
        />
    </div>

    @if ($label || $description)
        <div class="ml-2.5 text-sm">
            @if ($label)
                <label for="{{ $id }}" class="font-medium text-zinc-700 dark:text-zinc-300 select-none cursor-pointer">
                    {{ $label }}
                </label>
            @endif
            @if ($description)
                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $description }}</p>
            @endif
            @if ($error)
                <p class="text-xs text-red-600 dark:text-red-400 mt-0.5">{{ $error }}</p>
            @endif
        </div>
    @endif
</div>
