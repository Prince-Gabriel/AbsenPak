<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'guru_id',
        'mata_pelajaran',
        'kelas',
        'jam_mulai',
        'jam_selesai',
        'hari',
    ];

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function absensiGuru()
    {
        return $this->hasMany(AbsensiGuru::class);
    }

    public function absensiSiswa()
    {
        return $this->hasMany(AbsensiSiswa::class);
    }
} 