<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\MataPelajaran;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        // Create mata pelajaran
        $mataPelajaran = [
            ['nama' => 'Matematika'],
            ['nama' => 'Bahasa Indonesia'],
            ['nama' => 'Bahasa Inggris'],
            ['nama' => 'Fisika'],
            ['nama' => 'Kimia'],
            ['nama' => 'Biologi'],
            ['nama' => 'Sejarah'],
            ['nama' => 'Geografi'],
            ['nama' => 'Ekonomi'],
            ['nama' => 'Sosiologi'],
            ['nama' => 'Pendidikan Agama'],
            ['nama' => 'Pendidikan Kewarganegaraan'],
            ['nama' => 'Seni Budaya'],
            ['nama' => 'Pendidikan Jasmani'],
            ['nama' => 'Teknologi Informasi'],
        ];

        foreach ($mataPelajaran as $mp) {
            MataPelajaran::create($mp);
        }

        // Create kelas
        $kelas = [
            ['nama' => 'X IPA 1'],
            ['nama' => 'X IPA 2'],
            ['nama' => 'X IPA 3'],
            ['nama' => 'X IPS 1'],
            ['nama' => 'X IPS 2'],
            ['nama' => 'XI IPA 1'],
            ['nama' => 'XI IPA 2'],
            ['nama' => 'XI IPA 3'],
            ['nama' => 'XI IPS 1'],
            ['nama' => 'XI IPS 2'],
            ['nama' => 'XII IPA 1'],
            ['nama' => 'XII IPA 2'],
            ['nama' => 'XII IPA 3'],
            ['nama' => 'XII IPS 1'],
            ['nama' => 'XII IPS 2'],
        ];

        foreach ($kelas as $k) {
            Kelas::create($k);
        }
    }
} 