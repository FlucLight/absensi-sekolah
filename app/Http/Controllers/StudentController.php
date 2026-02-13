<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    public function index(Request $request) // Tambahkan (Request $request) di sini
    {
        // 1. Inisialisasi query
        $query = Student::with('schoolClass');

        // 2. Logika Search (cari berdasarkan nama)
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // 3. Logika Filter Kelas (cari berdasarkan id kelas)
        if ($request->filled('class_id')) {
            $query->where('school_class_id', $request->class_id);
        }

        // 4. Eksekusi query
        $students = $query->latest()->get();

        // 5. AMBIL DATA KELAS (Ini yang bikin eror tadi kalau gak ada)
        $classes = SchoolClass::all();

        // 6. Lempar semua variabel ke view
        return view('students.index', compact('students', 'classes'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view('students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required|exists:school_classes,id',
            'no_absen' => 'required|integer',
            'nama' => 'required|string|max:255',
        ]);

        Student::create([
            'school_class_id' => $request->school_class_id,
            'no_absen' => $request->no_absen,
            'nama' => $request->nama,
            'qr_code' => Str::uuid(), // AUTO GENERATE QR
        ]);

        return redirect()->route('students.index')
            ->with('success', 'Siswa berhasil ditambahkan!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
            ->with('success', 'Siswa berhasil dihapus!');
    }

    public function downloadQr(SchoolClass $class)
    {
        // 1. Ambil data siswa berdasarkan kelasnya
        $students = Student::where('school_class_id', $class->id)->get();

        // 2. Load View sambil setting opsi 'isRemoteEnabled'
        $pdf = Pdf::loadView('students.qr-pdf', compact('students', 'class'))
            ->setPaper('a4', 'portrait') // Opsional: biar rapi di kertas A4
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true, // WAJIB: biar gambar dari internet muncul
            ]);

        // 3. Download filenya
        return $pdf->download('QR-' . $class->name . '.pdf');
    }
}
