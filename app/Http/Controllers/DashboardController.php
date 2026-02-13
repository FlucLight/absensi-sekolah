<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $totalStudents = Student::count();

        $hadirToday = Attendance::where('tanggal', $today)->count();

        $telatToday = Attendance::where('tanggal', $today)
            ->where('status_telat', true)
            ->count();

        $belumHadir = $totalStudents - $hadirToday;

        $recentAttendances = Attendance::with('student')
            ->where('tanggal', $today)
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalStudents',
            'hadirToday',
            'belumHadir',
            'telatToday',
            'recentAttendances'
        ));
    }
}
