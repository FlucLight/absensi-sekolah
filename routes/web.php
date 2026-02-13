<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Models\Student;
use Illuminate\Support\Str;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('classes', SchoolClassController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('students', StudentController::class);
});

Route::get(
    '/classes/{class}/download-qr',
    [StudentController::class, 'downloadQr']
)->name('classes.download.qr');

Route::middleware(['auth'])->group(function () {
    Route::get('/scan', [AttendanceController::class, 'index'])->name('scan.index');
    Route::post('/scan', [AttendanceController::class, 'store'])->name('scan.store');
});

Route::get(
    '/attendance/today',
    [AttendanceController::class, 'today']
)->name('attendance.today');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

require __DIR__ . '/auth.php';
