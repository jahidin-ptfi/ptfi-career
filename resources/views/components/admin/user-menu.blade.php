<x-ui.dropdown align="right" width="w-56">
    <x-slot:trigger>
        <button
            type="button"
            class="flex items-center gap-2.5 p-1 rounded-lg hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
            aria-label="User menu"
        >
            <x-ui.avatar initials="AD" size="sm" status="online" />
            <div class="hidden sm:flex flex-col text-left">
                <span class="text-xs font-semibold text-zinc-800 dark:text-zinc-200 leading-tight">Admin Demo</span>
                <span class="text-[10px] text-zinc-400 dark:text-zinc-500">Super Admin</span>
            </div>
            <svg class="w-3.5 h-3.5 text-zinc-400 dark:text-zinc-500 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </x-slot:trigger>

    <div class="px-3 py-2 border-b border-zinc-100 dark:border-zinc-800">
        <p class="text-xs font-semibold text-zinc-900 dark:text-zinc-100">Admin Demo</p>
        <p class="text-[11px] text-zinc-500 dark:text-zinc-400 truncate">admin@fluxblade.internal</p>
    </div>

    <div class="py-1">
        <a 
            href="{{ route('admin.profile') ?? '/admin/profile' }}" 
            class="flex items-center gap-2 px-3 py-2 text-xs text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800 rounded-md transition-colors"
        >
            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span>Profil Pengguna</span>
        </a>

        <a 
            href="{{ route('admin.settings') ?? '/admin/settings' }}" 
            class="flex items-center gap-2 px-3 py-2 text-xs text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800 rounded-md transition-colors"
        >
            <svg class="w-4 h-4 text-zinc-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span>Pengaturan Akun</span>
        </a>
    </div>

    <div class="pt-1 border-t border-zinc-100 dark:border-zinc-800">
        <form method="POST" action="{{ route('logout') ?? '/logout' }}">
            @csrf
            <button 
                type="submit" 
                class="w-full flex items-center gap-2 px-3 py-2 text-xs text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/40 rounded-md transition-colors"
            >
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Keluar (Sign Out)</span>
            </button>
        </form>
    </div>
</x-ui.dropdown>
