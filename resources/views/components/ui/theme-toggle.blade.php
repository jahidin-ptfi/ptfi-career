<div 
    x-data="{ 
        open: false,
        theme: $store.theme.current,
        setTheme(mode) {
            this.theme = mode;
            $store.theme.set(mode);
            this.open = false;
        }
    }" 
    class="relative inline-block text-left"
>
    <!-- Toggle Button -->
    <button
        type="button"
        @click="open = !open"
        @click.outside="open = false"
        class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-zinc-200 bg-white text-zinc-700 shadow-2xs hover:bg-zinc-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 transition-colors"
        aria-label="Toggle theme mode"
    >
        <!-- Sun icon for light mode -->
        <svg x-show="theme === 'light'" class="w-4 h-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>

        <!-- Moon icon for dark mode -->
        <svg x-show="theme === 'dark'" class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>

        <!-- System icon for auto -->
        <svg x-show="theme === 'system'" class="w-4 h-4 text-zinc-500 dark:text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
    </button>

    <!-- Theme Dropdown Panel -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute right-0 z-50 mt-1.5 w-36 rounded-lg border border-zinc-200/80 bg-white p-1 text-xs shadow-lg ring-1 ring-black/5 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-200"
        style="display: none;"
    >
        <button
            type="button"
            @click="setTheme('light')"
            class="flex items-center gap-2 w-full px-2.5 py-1.5 rounded-md transition-colors"
            :class="theme === 'light' ? 'bg-zinc-100 text-blue-600 font-medium dark:bg-zinc-800 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-800/60'"
        >
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <span>Light Mode</span>
        </button>

        <button
            type="button"
            @click="setTheme('dark')"
            class="flex items-center gap-2 w-full px-2.5 py-1.5 rounded-md transition-colors"
            :class="theme === 'dark' ? 'bg-zinc-100 text-blue-600 font-medium dark:bg-zinc-800 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-800/60'"
        >
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
            </svg>
            <span>Dark Mode</span>
        </button>

        <button
            type="button"
            @click="setTheme('system')"
            class="flex items-center gap-2 w-full px-2.5 py-1.5 rounded-md transition-colors"
            :class="theme === 'system' ? 'bg-zinc-100 text-blue-600 font-medium dark:bg-zinc-800 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-800/60'"
        >
            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span>System</span>
        </button>
    </div>
</div>
