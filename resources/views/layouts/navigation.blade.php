<div class="md:hidden bg-gray-950/80 backdrop-blur-md border-b border-white/10 px-4 py-3 flex items-center justify-between sticky top-0 z-[60] w-full">
    <div class="flex items-center space-x-3">
        <div class="p-1.5 bg-indigo-600 rounded-lg">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 114 0"></path>
            </svg>
        </div>
        <span class="text-white font-black tracking-tighter">ABSENSI<span class="text-indigo-500">PRO</span></span>
    </div>

    <button @click="openMobile = !openMobile" class="p-2 text-gray-400 hover:text-white transition-colors focus:outline-none">
        <svg x-show="!openMobile" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
        <svg x-show="openMobile" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
</div>

<div x-show="openMobile"
    x-cloak
    @click="openMobile = false"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[51] md:hidden">
</div>

<nav :class="openMobile ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    class="fixed top-0 left-0 flex flex-col h-screen w-64 bg-gray-950 border-r border-white/10 z-[55] overflow-y-auto transition-transform duration-300 ease-in-out">

    <div class="p-6 border-b border-white/5 bg-gradient-to-b from-white/[0.02] to-transparent hidden md:block">
        <div class="flex items-center space-x-3">
            <div class="p-1.5 bg-indigo-600 rounded-lg shadow-lg shadow-indigo-600/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 114 0"></path>
                </svg>
            </div>
            <span class="text-xl font-black text-white tracking-tighter italic">ABSENSI<span class="text-indigo-500 text-sm">PRO</span></span>
        </div>
    </div>

    <div class="p-6 border-b border-white/5">
        <div class="flex items-center space-x-4">
            <div class="h-10 w-10 rounded-xl bg-indigo-500 flex items-center justify-center font-bold text-white shadow-lg shadow-indigo-500/20">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] text-indigo-400 font-black tracking-widest uppercase">Admin</p>
            </div>
        </div>
    </div>

    <div class="flex-1 px-4 py-6 space-y-1">
        @php
        $links = [
        ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
        ['route' => 'classes.index', 'label' => 'Classes', 'icon' => 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10'],
        ['route' => 'students.index', 'label' => 'Students', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197'],
        ['route' => 'scan.index', 'label' => 'Scan QR', 'icon' => 'M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z'],
        ['route' => 'attendance.today', 'label' => 'Today', 'icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ];
        @endphp

        @foreach($links as $link)
        <a href="{{ route($link['route']) }}"
            @click="openMobile = false"
            class="group flex items-center px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 {{ request()->routeIs($link['route']) ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs($link['route']) ? 'text-white' : 'text-gray-500 group-hover:text-indigo-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"></path>
            </svg>
            {{ $link['label'] }}
        </a>
        @endforeach
    </div>

    <div class="p-4 border-t border-white/5">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full flex items-center justify-center space-x-2 px-4 py-3 text-sm font-bold text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l-4-4m0 0l4-4m-4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Keluar Aplikasi</span>
            </button>
        </form>
    </div>
</nav>