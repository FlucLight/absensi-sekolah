<x-app-layout>
    <div class="p-8 max-w-7xl mx-auto min-h-screen bg-gray-900 text-gray-100">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-white tracking-tight">Monitoring Absensi</h1>
                <p class="text-gray-400 mt-1">Status kehadiran siswa hari ini secara real-time.</p>
            </div>

            <form method="GET" class="relative">
                <select name="class_id" onchange="this.form.submit()"
                    class="appearance-none pl-4 pr-10 py-2.5 rounded-xl bg-gray-800 border-gray-700 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all cursor-pointer min-w-[200px]">
                    <option value="">Semua Kelas</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $selectedClass == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}
                    </option>
                    @endforeach
                </select>
                <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </form>
        </div>

        <div class="bg-gray-800/50 backdrop-blur-xl rounded-2xl border border-gray-700 shadow-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-900/60 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-semibold">Nama Siswa</th>
                            <th class="px-6 py-4 font-semibold text-center">Masuk</th>
                            <th class="px-6 py-4 font-semibold text-center">Keluar</th>
                            <th class="px-6 py-4 font-semibold text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/50">
                        @foreach($students as $student)
                        @php $attendance = $student->attendances->first(); @endphp
                        <tr class="hover:bg-gray-700/40 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-700 flex items-center justify-center text-white font-bold mr-4 shadow-lg group-hover:rotate-6 transition-transform">
                                        {{ substr($student->nama, 0, 1) }}
                                    </div>
                                    <span class="text-gray-200 font-semibold group-hover:text-indigo-400 transition-colors">{{ $student->nama }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center font-mono text-indigo-300">
                                {{ $attendance->jam_masuk ?? '--:--' }}
                            </td>
                            <td class="px-6 py-4 text-center font-mono text-violet-300">
                                {{ $attendance->jam_keluar ?? '--:--' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if(!$attendance)
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-red-500/10 text-red-400 border border-red-500/20 shadow-[0_0_15px_rgba(239,68,68,0.1)]">Belum Absen</span>
                                    @elseif($attendance->status_telat)
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 shadow-[0_0_15px_rgba(245,158,11,0.1)]">Terlambat</span>
                                    @else
                                    <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 shadow-[0_0_15px_rgba(16,185,129,0.1)]">Tepat Waktu</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>