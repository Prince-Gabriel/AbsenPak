<?php

namespace Database\Seeders;

use App\Models\AbsensiSiswa;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class AbsensiSiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = User::where('role', 'siswa')->first();
        $guruPiket = User::where('role', 'guru_piket')->first();
        $schedule = Schedule::first();

        // Absensi hari ini
        AbsensiSiswa::create([
            'siswa_id' => $siswa->id,
            'schedule_id' => $schedule->id,
            'tanggal' => now(),
            'jam_masuk' => '07:00',
            'jam_keluar' => '08:30',
            'status' => 'hadir',
            'keterangan' => null,
            'guru_piket_id' => $guruPiket->id,
        ]);

        // Absensi kemarin
        AbsensiSiswa::create([
            'siswa_id' => $siswa->id,
            'schedule_id' => $schedule->id,
            'tanggal' => now()->subDay(),
            'jam_masuk' => '07:20',
            'jam_keluar' => '08:30',
            'status' => 'terlambat',
            'keterangan' => 'Terlambat karena bangun kesiangan',
            'guru_piket_id' => $guruPiket->id,
        ]);
    }
} 