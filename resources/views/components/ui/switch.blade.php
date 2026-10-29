@props([
    'name' => null,
    'id' => null,
    'label' => null,
    'description' => null,
    'checked' => false,
    'disabled' => false,
])

@php
$id = $id ?? ($name ?? 'switch_' . uniqid());
@endphp

<div 
    x-data="{ active: {{ $checked ? 'true' : 'false' }} }" 
    class="flex items-center justify-between gap-4"
>
    @if ($label || $description)
        <div class="flex flex-col">
            @if ($label)
                <label @click="if(!{{ $disabled ? 'true' : 'false' }}) active = !active" class="text-sm font-medium text-zinc-900 dark:text-zinc-100 select-none cursor-pointer">
                    {{ $label }}
                </label>
            @endif
            @if ($description)
                <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ $description }}</span>
            @endif
        </div>
    @endif

    <button
        type="button"
        role="switch"
        :aria-checked="active"
        @click="if(!{{ $disabled ? 'true' : 'false' }}) active = !active"
        {{ $disabled ? 'disabled' : '' }}
        class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
        :class="active ? 'bg-blue-600 dark:bg-blue-600' : 'bg-zinc-200 dark:bg-zinc-700'"
    >
        <span class="sr-only">{{ $label ?? 'Toggle switch' }}</span>
        <span
            aria-hidden="true"
            class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow-sm ring-0 transition duration-200 ease-in-out dark:bg-zinc-100"
            :class="active ? 'translate-x-5' : 'translate-x-0'"
        ></span>
    </button>

    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="active ? '1' : '0'" id="{{ $id }}">
    @endif
</div>
