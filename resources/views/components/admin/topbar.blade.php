<header class="sticky top-0 z-20 flex h-16 shrink-0 items-center justify-between border-b border-zinc-200/80 bg-white/80 backdrop-blur-md px-4 sm:px-6 lg:px-8 dark:border-zinc-800 dark:bg-zinc-900/80">
    <div class="flex items-center gap-3 flex-1 min-w-0">
        <!-- Mobile Sidebar Hamburger -->
        <button
            type="button"
            @click="mobileSidebarOpen = true"
            class="p-2 -ml-2 rounded-lg text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100 lg:hidden focus:outline-none"
            aria-label="Open sidebar"
        >
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Global Search Field -->
        <div class="relative max-w-xs w-full hidden sm:block">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-zinc-400">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input
                type="text"
                placeholder="Cari fitur, data, atau aksi... (⌘K)"
                class="w-full rounded-lg border border-zinc-200 bg-zinc-50 pl-9 pr-3 py-1.5 text-xs text-zinc-900 placeholder-zinc-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-zinc-800 dark:bg-zinc-800/60 dark:text-zinc-100 dark:placeholder-zinc-500 dark:focus:bg-zinc-900 transition-colors"
            />
        </div>
    </div>

    <!-- Right Header Actions -->
    <div class="flex items-center gap-3">
        <!-- Notification indicator -->
        <button 
            type="button"
            class="relative p-2 rounded-lg text-zinc-500 hover:bg-zinc-100 hover:text-zinc-700 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-200 focus:outline-none transition-colors"
            aria-label="Notifikasi"
            @click="$store.toasts.add({ title: 'Notifikasi Baru', message: 'Laporan keuangan bulan Oktober telah siap diunduh.', type: 'info' })"
        >
            <svg class="w-4.5 h-4.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-2 right-2 w-2 h-2 bg-blue-600 rounded-full ring-2 ring-white dark:ring-zinc-900"></span>
        </button>

        <!-- Theme Switcher -->
        <x-ui.theme-toggle />

        <!-- User Dropdown Menu -->
        <x-admin.user-menu />
    </div>
</header>
