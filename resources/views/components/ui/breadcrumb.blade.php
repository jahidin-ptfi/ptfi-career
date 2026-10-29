@props([
    'items' => [],
])

<nav class="flex items-center text-xs font-medium text-zinc-500 dark:text-zinc-400" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1.5 md:space-x-2">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') ?? '/admin' }}" class="inline-flex items-center text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition-colors">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>
        </li>

        @foreach ($items as $label => $url)
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-zinc-400 dark:text-zinc-600 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                    @if ($url && !$loop->last)
                        <a href="{{ $url }}" class="text-zinc-600 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-zinc-100 transition-colors">
                            {{ $label }}
                        </a>
                    @else
                        <span class="text-zinc-800 font-semibold dark:text-zinc-200" aria-current="page">
                            {{ $label }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>
