<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

class Student extends Model
{
    protected $fillable = ['school_class_id', 'no_absen', 'nama', 'qr_code'];

    // Relasi ke Kelas (Sudah ada mungkin)
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    // TAMBAHKAN INI: Relasi ke tabel Attendance
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
