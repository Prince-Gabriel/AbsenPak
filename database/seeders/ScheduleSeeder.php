<?php

namespace Database\Seeders;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run(): void
    {
        $guru = User::where('role', 'guru')->first();

        // Jadwal Senin
        Schedule::create([
            'guru_id' => $guru->id,
            'mata_pelajaran' => 'Matematika',
            'kelas' => 'X IPA 1',
            'jam_mulai' => '07:00',
            'jam_selesai' => '08:30',
            'hari' => 'Senin',
        ]);

        Schedule::create([
            'guru_id' => $guru->id,
            'mata_pelajaran' => 'Fisika',
            'kelas' => 'X IPA 2',
            'jam_mulai' => '09:00',
            'jam_selesai' => '10:30',
            'hari' => 'Senin',
        ]);

        // Jadwal Selasa
        Schedule::create([
            'guru_id' => $guru->id,
            'mata_pelajaran' => 'Kimia',
            'kelas' => 'X IPA 1',
            'jam_mulai' => '07:00',
            'jam_selesai' => '08:30',
            'hari' => 'Selasa',
        ]);

        Schedule::create([
            'guru_id' => $guru->id,
            'mata_pelajaran' => 'Biologi',
            'kelas' => 'X IPA 2',
            'jam_mulai' => '09:00',
            'jam_selesai' => '10:30',
            'hari' => 'Selasa',
        ]);
    }
} 