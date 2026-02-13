<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SchoolClass;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('scan.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'qr_code' => 'required'
        ]);

        $student = Student::where('qr_code', $request->qr_code)->first();

        if (!$student) {
            return response()->json(['message' => 'QR tidak valid'], 404);
        }

        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->format('H:i:s');

        $attendance = Attendance::where('student_id', $student->id)
            ->where('tanggal', $today)
            ->first();

        // Kalau belum ada → Absen Masuk
        if (!$attendance) {

            $isLate = Carbon::now()->gt(Carbon::createFromTime(7, 0, 0));

            Attendance::create([
                'student_id' => $student->id,
                'tanggal' => $today,
                'jam_masuk' => $now,
                'status_telat' => $isLate
            ]);

            return response()->json([
                'message' => $student->nama . ' berhasil absen MASUK'
            ]);
        }

        // Kalau sudah ada & belum pulang → Absen Keluar
        if (!$attendance->jam_keluar) {

            $attendance->update([
                'jam_keluar' => $now
            ]);

            return response()->json([
                'message' => $student->nama . ' berhasil absen KELUAR'
            ]);
        }

        return response()->json([
            'message' => 'Sudah absen masuk & keluar hari ini'
        ]);
    }

    public function today(Request $request)
    {
        $today = now()->toDateString();

        $classes = SchoolClass::all();

        $selectedClass = $request->class_id;

        $students = \App\Models\Student::with(['schoolClass', 'attendances' => function ($q) use ($today) {
            $q->where('tanggal', $today);
        }]);

        if ($selectedClass) {
            $students->where('school_class_id', $selectedClass);
        }

        $students = $students->get();

        return view('attendance.today', compact('students', 'classes', 'selectedClass'));
    }
}
