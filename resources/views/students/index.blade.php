<x-app-layout>
    <div class="w-full min-h-full bg-transparent p-4 sm:p-6 lg:p-8">
        <div class="max-w-full mx-auto">

            <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6 mb-8">
                <div class="space-y-1">
                    <h1 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                        Database <span class="text-indigo-500">Siswa</span>
                    </h1>
                    <p class="text-gray-400 text-sm font-medium flex items-center gap-2">
                        <span class="flex h-2 w-2 rounded-full bg-green-500"></span>
                        {{ $students->count() }} Siswa Ditampilkan
                    </p>
                </div>

                <form method="GET" action="{{ route('students.index') }}" class="flex flex-col md:flex-row items-stretch md:items-center gap-4">

                    <div class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa..."
                            class="bg-gray-800/50 border border-white/10 text-gray-200 text-sm rounded-2xl px-4 py-3 sm:py-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition w-full md:w-64 backdrop-blur-md">
                        <svg class="w-4 h-4 text-gray-500 absolute right-4 top-3.5 sm:top-3 group-hover:text-indigo-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    <div class="relative min-w-[180px]">
                        <select name="class_id" onchange="this.form.submit()"
                            class="w-full bg-gray-800/50 border border-white/10 text-gray-200 text-sm rounded-2xl px-4 py-3 sm:py-2.5 focus:ring-2 focus:ring-indigo-500 focus:outline-none transition appearance-none backdrop-blur-md">
                            <option value="">Semua Kelas</option>
                            @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 md:flex-none px-6 py-2.5 bg-gray-700 hover:bg-gray-600 text-white font-bold rounded-2xl transition-all active:scale-95">
                            Filter
                        </button>

                        @if(request('search') || request('class_id'))
                        <a href="{{ route('students.index') }}" class="px-4 py-2.5 bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white rounded-2xl transition-all flex items-center justify-center" title="Reset Filter">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                        @endif

                        <a href="{{ route('students.create') }}"
                            class="flex-1 md:flex-none flex items-center justify-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 transition-all duration-300 text-white font-bold rounded-2xl shadow-lg shadow-indigo-600/20 active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                            </svg>
                            <span>Tambah</span>
                        </a>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 items-start gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">

                @forelse($students as $student)
                <div class="relative bg-white/[0.03] backdrop-blur-xl border border-white/10 
                            rounded-[2rem] p-5 text-center group 
                            hover:bg-white/[0.07] hover:border-indigo-500/50 
                            transition-all duration-500 shadow-xl overflow-hidden">

                    <div class="absolute -top-24 -left-24 w-48 h-48 bg-indigo-600/10 blur-[80px] group-hover:bg-indigo-600/20 transition-all duration-500 rounded-full"></div>

                    <form action="{{ route('students.destroy', $student) }}" method="POST"
                        class="absolute top-4 right-4 z-10 opacity-0 group-hover:opacity-100 transition-all duration-300 translate-y-2 group-hover:translate-y-0">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus siswa ini?')" class="p-2.5 bg-gray-900/80 text-rose-500 border border-white/5 rounded-xl hover:bg-rose-600 hover:text-white transition-all shadow-xl">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>

                    <div class="relative z-10">
                        <div class="h-20 w-20 mx-auto rounded-3xl rotate-3 
                                    bg-gradient-to-br from-indigo-500 to-violet-600 
                                    flex items-center justify-center 
                                    text-white font-black text-2xl 
                                    shadow-2xl shadow-indigo-500/40 group-hover:rotate-0 transition-transform duration-500">
                            {{ substr($student->nama, 0, 1) }}
                        </div>

                        <div class="mt-4 px-2">
                            <h3 class="text-lg font-black text-white truncate group-hover:text-indigo-400 transition-colors">
                                {{ $student->nama }}
                            </h3>
                            <p class="text-[10px] text-gray-500 font-black tracking-[0.2em] uppercase mt-1">
                                {{ $student->schoolClass->name ?? 'Tanpa Kelas' }}
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 relative z-10 flex justify-center">
                        <div class="bg-white p-3 rounded-[1.5rem] shadow-2xl transition-transform duration-500 group-hover:scale-110">
                            {!! QrCode::size(120)->margin(1)->generate($student->qr_code) !!}
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-white/5 flex items-center justify-center gap-2">
                        <span class="px-4 py-1.5 text-[10px] font-black 
                                     bg-white/5 text-gray-400 border border-white/5
                                     rounded-full tracking-widest uppercase group-hover:bg-indigo-600 group-hover:text-white transition-all">
                            ABSEN #{{ str_pad($student->no_absen, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center">
                    <div class="inline-flex p-6 bg-gray-800/50 rounded-full mb-4">
                        <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-400 font-bold">Yah, siswa yang lu cari gak nemu Bre...</p>
                    <a href="{{ route('students.index') }}" class="text-indigo-500 text-sm hover:underline mt-2 inline-block">Reset Pencarian</a>
                </div>
                @endforelse

            </div>

        </div>
    </div>
</x-app-layout>