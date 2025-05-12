<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AbsensiSiswa;
use Illuminate\Http\Request;

class AbsensiSiswaController extends Controller
{
    public function index()
    {
        $absensi = AbsensiSiswa::with(['siswa', 'schedule', 'guruPiket'])->get();
        return response()->json($absensi);
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'status' => 'required|in:hadir,terlambat,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
            'guru_piket_id' => 'nullable|exists:users,id',
        ]);

        $absensi = AbsensiSiswa::create($request->all());

        return response()->json([
            'message' => 'Absensi siswa created successfully',
            'absensi' => $absensi,
        ], 201);
    }

    public function show(AbsensiSiswa $absensiSiswa)
    {
        return response()->json($absensiSiswa->load(['siswa', 'schedule', 'guruPiket']));
    }

    public function update(Request $request, AbsensiSiswa $absensiSiswa)
    {
        $request->validate([
            'siswa_id' => 'exists:users,id',
            'schedule_id' => 'exists:schedules,id',
            'tanggal' => 'date',
            'jam_masuk' => 'date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'status' => 'in:hadir,terlambat,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
            'guru_piket_id' => 'nullable|exists:users,id',
        ]);

        $absensiSiswa->update($request->all());

        return response()->json([
            'message' => 'Absensi siswa updated successfully',
            'absensi' => $absensiSiswa,
        ]);
    }

    public function destroy(AbsensiSiswa $absensiSiswa)
    {
        $absensiSiswa->delete();

        return response()->json([
            'message' => 'Absensi siswa deleted successfully',
        ]);
    }

    public function absensiHariIni()
    {
        $absensi = AbsensiSiswa::with(['siswa', 'schedule', 'guruPiket'])
            ->whereDate('tanggal', today())
            ->get();

        return response()->json($absensi);
    }

    public function validasiAbsensi(Request $request, AbsensiSiswa $absensiSiswa)
    {
        $request->validate([
            'guru_piket_id' => 'required|exists:users,id',
            'status' => 'required|in:hadir,terlambat,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $absensiSiswa->update($request->all());

        return response()->json([
            'message' => 'Absensi siswa validated successfully',
            'absensi' => $absensiSiswa,
        ]);
    }
} 