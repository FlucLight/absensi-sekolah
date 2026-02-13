<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 py-12 px-6">
        <div class="max-w-2xl mx-auto">

            <!-- CARD -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 
                        rounded-3xl shadow-2xl p-8">

                <!-- HEADER -->
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-extrabold text-white tracking-tight">
                        Tambah Siswa
                    </h1>
                    <p class="text-gray-400 mt-2 text-sm">
                        Masukkan data siswa baru ke dalam sistem
                    </p>
                </div>

                <form action="{{ route('students.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- PILIH KELAS -->
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">
                            Pilih Kelas
                        </label>
                        <select name="school_class_id"
                            class="w-full bg-gray-800/70 border border-gray-700 
                                   text-gray-200 rounded-xl px-4 py-3 
                                   focus:ring-2 focus:ring-indigo-500 
                                   focus:outline-none transition">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">
                                    {{ $class->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- NO ABSEN -->
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">
                            Nomor Absen
                        </label>
                        <input type="number"
                               name="no_absen"
                               placeholder="Masukkan nomor absen"
                               class="w-full bg-gray-800/70 border border-gray-700 
                                      text-white rounded-xl px-4 py-3 
                                      focus:ring-2 focus:ring-indigo-500 
                                      focus:outline-none transition">
                    </div>

                    <!-- NAMA -->
                    <div>
                        <label class="block text-sm text-gray-400 mb-2">
                            Nama Siswa
                        </label>
                        <input type="text"
                               name="nama"
                               placeholder="Masukkan nama lengkap"
                               class="w-full bg-gray-800/70 border border-gray-700 
                                      text-white rounded-xl px-4 py-3 
                                      focus:ring-2 focus:ring-indigo-500 
                                      focus:outline-none transition">
                    </div>

                    <!-- BUTTON -->
                    <div class="pt-4 flex justify-between items-center">
                        <a href="{{ route('students.index') }}"
                           class="text-gray-400 hover:text-white transition text-sm">
                            ← Kembali
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 
                                   hover:scale-105 transition-all duration-300 
                                   text-white font-semibold rounded-2xl 
                                   shadow-lg shadow-green-500/20">
                            Simpan Siswa
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
