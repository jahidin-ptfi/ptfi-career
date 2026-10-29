<!-- Desktop Sidebar -->
<aside 
    :class="sidebarCollapsed ? 'lg:w-20' : 'lg:w-64'"
    class="hidden lg:flex flex-col shrink-0 border-r border-zinc-200/80 bg-white dark:border-zinc-800 dark:bg-zinc-900 transition-all duration-200 select-none z-30"
>
    <!-- Brand / Header -->
    <div class="h-16 flex items-center justify-between px-4 border-b border-zinc-200/80 dark:border-zinc-800">
        <a href="{{ route('admin.dashboard') ?? '/admin' }}" class="flex items-center gap-2.5 overflow-hidden">
            <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white shrink-0 shadow-xs">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            </div>
            <span x-show="!sidebarCollapsed" class="font-semibold text-zinc-900 dark:text-white text-base tracking-tight truncate">
                Flux<span class="text-blue-600 dark:text-blue-400">Admin</span>
            </span>
        </a>

        <!-- Collapse Toggle -->
        <button
            type="button"
            @click="sidebarCollapsed = !sidebarCollapsed"
            class="p-1 rounded-md text-zinc-400 hover:bg-zinc-100 hover:text-zinc-600 dark:hover:bg-zinc-800 dark:hover:text-zinc-300"
            title="Collapse Sidebar"
        >
            <svg class="w-4 h-4 transition-transform duration-200" :class="sidebarCollapsed ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu Items -->
    <div class="flex-1 overflow-y-auto px-3 py-4 space-y-6">
        <!-- Main Section -->
        <div>
            <p x-show="!sidebarCollapsed" class="px-3 text-[11px] font-semibold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-2">
                Menu Utama
            </p>
            <nav class="space-y-1">
                <!-- Dashboard -->
                <a 
                    href="{{ route('admin.dashboard') ?? '/admin' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Dashboard</span>
                </a>

                <!-- User Management -->
                <a 
                    href="{{ route('admin.users.index') ?? '/admin/users' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Manajemen Pengguna</span>
                </a>
            </nav>
        </div>

        <!-- Design System & Examples Section -->
        <div>
            <p x-show="!sidebarCollapsed" class="px-3 text-[11px] font-semibold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-2">
                UI Examples (Flux)
            </p>
            <nav class="space-y-1">
                <!-- Form Elements -->
                <a 
                    href="{{ route('admin.examples.form') ?? '/admin/examples/form-elements' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.examples.form') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Form Elements</span>
                </a>

                <!-- Data Table -->
                <a 
                    href="{{ route('admin.examples.table') ?? '/admin/examples/table' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.examples.table') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Data Table</span>
                </a>

                <!-- Modals & Dialogs -->
                <a 
                    href="{{ route('admin.examples.modal') ?? '/admin/examples/modal' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.examples.modal') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Modals & Dialogs</span>
                </a>

                <!-- UI Components -->
                <a 
                    href="{{ route('admin.examples.ui') ?? '/admin/examples/ui-components' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.examples.ui') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">All UI Components</span>
                </a>
            </nav>
        </div>

        <!-- Settings Section -->
        <div>
            <p x-show="!sidebarCollapsed" class="px-3 text-[11px] font-semibold text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-2">
                Preferensi
            </p>
            <nav class="space-y-1">
                <a 
                    href="{{ route('admin.profile') ?? '/admin/profile' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.profile') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Profil Saya</span>
                </a>

                <a 
                    href="{{ route('admin.settings') ?? '/admin/settings' }}" 
                    class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.settings') ? 'bg-blue-50 text-blue-700 font-semibold dark:bg-blue-950/60 dark:text-blue-400' : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-zinc-100' }}"
                >
                    <svg class="w-4.5 h-4.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span x-show="!sidebarCollapsed" class="truncate">Pengaturan Sistem</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Bottom User Section -->
    <div class="p-3 border-t border-zinc-200/80 dark:border-zinc-800">
        <a href="{{ route('home') ?? '/' }}" class="flex items-center gap-3 px-3 py-2 text-xs font-medium text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span x-show="!sidebarCollapsed" class="truncate">Kembali ke Website</span>
        </a>
    </div>
</aside>

<!-- Mobile Sidebar Drawer -->
<div 
    x-show="mobileSidebarOpen" 
    class="fixed inset-0 z-50 lg:hidden"
    style="display: none;"
>
    <!-- Backdrop -->
    <div 
        x-show="mobileSidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="mobileSidebarOpen = false"
        class="fixed inset-0 bg-zinc-950/50 backdrop-blur-xs"
    ></div>

    <!-- Drawer Content -->
    <div 
        x-show="mobileSidebarOpen"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="-translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="relative flex flex-col w-72 max-w-xs h-full bg-white dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-800 p-4"
    >
        <div class="flex items-center justify-between pb-4 border-b border-zinc-200 dark:border-zinc-800">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="font-bold text-zinc-900 dark:text-white">FluxBlade</span>
            </div>
            <button @click="mobileSidebarOpen = false" class="p-1 rounded-md text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 mt-4 space-y-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard') ?? '/admin' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                Dashboard
            </a>
            <a href="{{ route('admin.users.index') ?? '/admin/users' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                Manajemen Pengguna
            </a>
            <a href="{{ route('admin.examples.form') ?? '/admin/examples/form-elements' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                Form Elements
            </a>
            <a href="{{ route('admin.examples.table') ?? '/admin/examples/table' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                Data Table
            </a>
            <a href="{{ route('admin.examples.modal') ?? '/admin/examples/modal' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                Modals & Dialogs
            </a>
            <a href="{{ route('admin.examples.ui') ?? '/admin/examples/ui-components' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                UI Components
            </a>
            <div class="pt-4 border-t border-zinc-200 dark:border-zinc-800">
                <a href="{{ route('admin.profile') ?? '/admin/profile' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300">
                    Profil Saya
                </a>
                <a href="{{ route('admin.settings') ?? '/admin/settings' }}" class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-zinc-700 dark:text-zinc-300">
                    Pengaturan
                </a>
            </div>
        </nav>
    </div>
</div>
