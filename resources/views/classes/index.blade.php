<x-app-layout>
    <div class="p-8 max-w-7xl mx-auto bg-gray-900 min-h-screen">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-3xl font-extrabold text-white">Daftar Kelas</h1>
                <p class="text-gray-400">Total: {{ $classes->count() }} Kelas Terdaftar</p>
            </div>
            <a href="{{ route('classes.create') }}" class="group inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white font-bold rounded-2xl transition-all shadow-xl shadow-indigo-500/30">
                <svg class="w-5 h-5 mr-2 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kelas
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($classes as $class)
            <div class="group bg-gray-800 border border-gray-700 p-8 rounded-3xl hover:border-indigo-500/50 hover:shadow-[0_0_30px_rgba(79,70,229,0.15)] transition-all relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-indigo-600/5 rounded-full group-hover:scale-150 transition-transform"></div>
                
                <div class="flex justify-between items-start mb-6 relative z-10">
                    <div class="h-14 w-14 bg-gray-900 rounded-2xl flex items-center justify-center text-indigo-400 border border-gray-700 group-hover:border-indigo-500/50 transition-colors">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('classes.download.qr', $class) }}" class="p-2.5 text-emerald-400 hover:bg-emerald-400/10 rounded-xl transition-all" title="Download QR">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        </a>
                        <form action="{{ route('classes.destroy', $class) }}" method="POST" onsubmit="return confirm('Hapus kelas?')">
                            @csrf @method('DELETE')
                            <button class="p-2.5 text-rose-400 hover:bg-rose-400/10 rounded-xl transition-all">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
                <h3 class="text-2xl font-black text-white group-hover:text-indigo-400 transition-colors uppercase tracking-tight">{{ $class->name }}</h3>
                <p class="text-gray-500 mt-2 text-sm">Kelola siswa dan absensi kelas ini.</p>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>