<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('guru')->get();
        return response()->json($schedules);
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:users,id',
            'mata_pelajaran' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
        ]);

        $schedule = Schedule::create($request->all());

        return response()->json([
            'message' => 'Schedule created successfully',
            'schedule' => $schedule,
        ], 201);
    }

    public function show(Schedule $schedule)
    {
        return response()->json($schedule->load('guru'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'guru_id' => 'exists:users,id',
            'mata_pelajaran' => 'string|max:255',
            'kelas' => 'string|max:255',
            'jam_mulai' => 'date_format:H:i',
            'jam_selesai' => 'date_format:H:i|after:jam_mulai',
            'hari' => 'in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
        ]);

        $schedule->update($request->all());

        return response()->json([
            'message' => 'Schedule updated successfully',
            'schedule' => $schedule,
        ]);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return response()->json([
            'message' => 'Schedule deleted successfully',
        ]);
    }
} 