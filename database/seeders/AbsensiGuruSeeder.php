<?php

namespace Database\Seeders;

use App\Models\AbsensiGuru;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class AbsensiGuruSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'guru')->first();
        $schedule = Schedule::first();

        // Absensi hari ini
        AbsensiGuru::create([
            'guru_id' => $guru->id,
            'schedule_id' => $schedule->id,
            'tanggal' => now(),
            'jam_masuk' => '07:00',
            'jam_keluar' => '08:30',
            'status' => 'hadir',
            'keterangan' => null,
        ]);

        // Absensi kemarin
        AbsensiGuru::create([
            'guru_id' => $guru->id,
            'schedule_id' => $schedule->id,
            'tanggal' => now()->subDay(),
            'jam_masuk' => '07:15',
            'jam_keluar' => '08:30',
            'status' => 'terlambat',
            'keterangan' => 'Terlambat karena macet',
        ]);
    }
} 