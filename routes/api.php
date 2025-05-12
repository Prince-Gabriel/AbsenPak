<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\AbsensiGuruController;
use App\Http\Controllers\API\AbsensiSiswaController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('schedules', ScheduleController::class);
        Route::apiResource('absensi-guru', AbsensiGuruController::class);
        Route::apiResource('absensi-siswa', AbsensiSiswaController::class);
    });

    // Guru routes
    Route::middleware('role:guru,guru_piket')->group(function () {
        Route::get('/schedules', [ScheduleController::class, 'index']);
        Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']);
        Route::get('/absensi-guru/hari-ini', [AbsensiGuruController::class, 'absensiHariIni']);
        Route::post('/absensi-guru', [AbsensiGuruController::class, 'store']);
        Route::put('/absensi-guru/{absensiGuru}', [AbsensiGuruController::class, 'update']);
    });

    // Guru piket routes
    Route::middleware('role:guru_piket')->group(function () {
        Route::get('/absensi-siswa/hari-ini', [AbsensiSiswaController::class, 'absensiHariIni']);
        Route::post('/absensi-siswa/{absensiSiswa}/validasi', [AbsensiSiswaController::class, 'validasiAbsensi']);
    });

    // Siswa routes
    Route::middleware('role:siswa')->group(function () {
        Route::get('/schedules', [ScheduleController::class, 'index']);
        Route::get('/schedules/{schedule}', [ScheduleController::class, 'show']);
        Route::get('/absensi-siswa/hari-ini', [AbsensiSiswaController::class, 'absensiHariIni']);
        Route::post('/absensi-siswa', [AbsensiSiswaController::class, 'store']);
    });
});
