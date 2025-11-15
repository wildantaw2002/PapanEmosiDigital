<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmosiController;

Route::view('/mahasiswa/papan-emosi', 'mahasiswa.papan-emosi');
Route::view('/mahasiswa', 'mahasiswa.app');
Route::view('/', 'mahasiswa.app');

// Guru dashboard view
Route::view('/guru/dashboard', 'guru.dashboard');

// API routes - return JSON
Route::post('/emosi', [EmosiController::class, 'store']);
Route::get('/emosi', [EmosiController::class, 'index']);
Route::get('/emosi/statistik', [EmosiController::class, 'statistik']);
