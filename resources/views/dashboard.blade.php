<x-app-layout>
    <div class="p-8 max-w-7xl mx-auto min-h-screen text-gray-100">

        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-4xl font-black text-white tracking-tighter">
                    DASHBOARD <span class="text-indigo-500">OVERVIEW</span>
                </h1>
                <p class="text-gray-400 mt-1 font-medium italic">Welcome back, {{ Auth::user()->name }}! Here's what's happening today.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('scan.index') }}"
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-3 rounded-2xl font-bold transition-all shadow-lg shadow-indigo-500/25 active:scale-95 group">
                    <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m0 11v1m5-10v1m0 11v1m-10-6h1m11 0h1M3 12h1m11 0h1M5 9l1 1m12-1l-1 1M5 15l1-1m12 1l-1-1"></path>
                    </svg>
                    Scan Absensi
                </a>
                <a href="{{ route('attendance.today') }}"
                    class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white px-6 py-3 rounded-2xl font-bold transition-all border border-gray-700 active:scale-95">
                    Laporan Hari Ini
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="relative overflow-hidden bg-gray-800 border border-gray-700 p-6 rounded-[2rem] shadow-xl group">
                <div class="absolute -right-4 -top-4 text-gray-700/20 group-hover:text-indigo-500/10 transition-colors">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                </div>
                <p class="text-gray-400 text-xs font-black uppercase tracking-widest mb-1">Total Siswa</p>
                <p class="text-4xl font-black text-white relative z-10">{{ $totalStudents }}</p>
                <div class="mt-4 flex items-center text-xs font-bold text-indigo-400">
                    <span>Terdaftar di sistem</span>
                </div>
            </div>

            <div class="relative overflow-hidden bg-emerald-500/10 border border-emerald-500/20 p-6 rounded-[2rem] shadow-xl group">
                <p class="text-emerald-500 text-xs font-black uppercase tracking-widest mb-1">Hadir Hari Ini</p>
                <p class="text-4xl font-black text-emerald-400 relative z-10">{{ $hadirToday }}</p>
                <div class="mt-4 flex items-center text-xs font-bold text-emerald-500/60">
                    <span class="bg-emerald-500/20 px-2 py-1 rounded-lg">Real-time Data</span>
                </div>
            </div>

            <div class="relative overflow-hidden bg-rose-500/10 border border-rose-500/20 p-6 rounded-[2rem] shadow-xl group">
                <p class="text-rose-500 text-xs font-black uppercase tracking-widest mb-1">Belum Hadir</p>
                <p class="text-4xl font-black text-rose-400 relative z-10">{{ $belumHadir }}</p>
                <div class="mt-4 flex items-center text-xs font-bold text-rose-500/60">
                    <span class="bg-rose-500/20 px-2 py-1 rounded-lg">Perlu Follow Up</span>
                </div>
            </div>

            <div class="relative overflow-hidden bg-amber-500/10 border border-amber-500/20 p-6 rounded-[2rem] shadow-xl group">
                <p class="text-amber-500 text-xs font-black uppercase tracking-widest mb-1">Terlambat</p>
                <p class="text-4xl font-black text-amber-400 relative z-10">{{ $telatToday }}</p>
                <div class="mt-4 flex items-center text-xs font-bold text-amber-500/60">
                    <span class="bg-amber-500/20 px-2 py-1 rounded-lg">Melebihi Batas</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 bg-gray-800/50 backdrop-blur-md border border-gray-700 rounded-[2.5rem] p-8 shadow-2xl">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-xl font-black text-white uppercase tracking-tight flex items-center gap-3">
                        <span class="h-8 w-1.5 bg-indigo-500 rounded-full"></span>
                        Aktivitas Terbaru
                    </h2>
                    <span class="text-xs font-bold text-gray-500 bg-gray-900 px-3 py-1 rounded-full border border-gray-700">Live Feed</span>
                </div>

                <div class="space-y-4">
                    @forelse($recentAttendances as $attendance)
                    <div class="flex items-center justify-between p-4 bg-gray-900/50 border border-gray-700/50 rounded-2xl hover:border-indigo-500/30 transition-all group">
                        <div class="flex items-center gap-4">
                            <div class="h-12 w-12 rounded-xl bg-indigo-600/20 flex items-center justify-center text-indigo-400 font-black border border-indigo-500/20 group-hover:scale-110 transition-transform">
                                {{ substr($attendance->student->nama, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $attendance->student->nama }}</p>
                                <p class="text-xs text-gray-500 font-medium italic">{{ $attendance->student->schoolClass->name }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-black text-indigo-300 font-mono">{{ $attendance->jam_masuk }}</p>
                            <p class="text-[10px] text-gray-600 uppercase font-bold tracking-tighter">Waktu WITA</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-10">
                        <p class="text-gray-500 font-medium italic">Belum ada aktivitas absensi hari ini.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-600 to-violet-800 rounded-[2.5rem] p-8 shadow-2xl shadow-indigo-500/20 flex flex-col justify-between overflow-hidden relative group">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>

                <div class="relative z-10">
                    <h3 class="text-2xl font-black text-white leading-tight mb-4">Efisiensi Absensi Digital</h3>
                    <p class="text-indigo-100 text-sm leading-relaxed opacity-80">
                        Sistem ini otomatis mendeteksi keterlambatan berdasarkan timezone WITA. Pastikan QR Code siswa dalam kondisi bersih saat proses scanning.
                    </p>
                </div>

                <div class="relative z-10 mt-8">
                    <div class="bg-black/20 backdrop-blur-md rounded-2xl p-4 border border-white/10">
                        <p class="text-xs text-indigo-200 font-bold uppercase mb-2">System Status</p>
                        <div class="flex items-center gap-2">
                            <span class="h-2 w-2 bg-emerald-400 rounded-full animate-pulse"></span>
                            <span class="text-sm text-white font-medium">All Systems Operational</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>