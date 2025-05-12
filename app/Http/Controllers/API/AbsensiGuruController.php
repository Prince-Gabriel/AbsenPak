<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AbsensiGuru;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
{
    public function index()
    {
        $absensi = AbsensiGuru::with(['guru', 'schedule'])->get();
        return response()->json($absensi);
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'status' => 'required|in:hadir,terlambat,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $absensi = AbsensiGuru::create($request->all());

        return response()->json([
            'message' => 'Absensi guru created successfully',
            'absensi' => $absensi,
        ], 201);
    }

    public function show(AbsensiGuru $absensiGuru)
    {
        return response()->json($absensiGuru->load(['guru', 'schedule']));
    }

    public function update(Request $request, AbsensiGuru $absensiGuru)
    {
        $request->validate([
            'guru_id' => 'exists:users,id',
            'schedule_id' => 'exists:schedules,id',
            'tanggal' => 'date',
            'jam_masuk' => 'date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'status' => 'in:hadir,terlambat,izin,sakit,alpha',
            'keterangan' => 'nullable|string',
        ]);

        $absensiGuru->update($request->all());

        return response()->json([
            'message' => 'Absensi guru updated successfully',
            'absensi' => $absensiGuru,
        ]);
    }

    public function destroy(AbsensiGuru $absensiGuru)
    {
        $absensiGuru->delete();

        return response()->json([
            'message' => 'Absensi guru deleted successfully',
        ]);
    }

    public function absensiHariIni()
    {
        $absensi = AbsensiGuru::with(['guru', 'schedule'])
            ->whereDate('tanggal', today())
            ->get();

        return response()->json($absensi);
    }
} 