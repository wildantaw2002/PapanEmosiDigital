<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmosiController;

Route::view('/mahasiswa/papan-emosi', 'mahasiswa.papan-emosi');
Route::view('/guru/papan-emosi', 'guru.papan-emosi');
Route::view('/guru', 'dosen.app');
Route::view('/', 'mahasiswa.app');

// API route

Route::post('/emosi', [EmosiController::class, 'store']);
Route::get('/emosi', [EmosiController::class, 'index']);
Route::get('/emosi/statistik', [EmosiController::class, 'statistik']);


Route::get('/guru/dashboard', [EmosiController::class, 'index'])->name('guru.dashboard');
Route::get('/api/emosi/statistik', [EmosiController::class, 'statistik']);
Route::post('/api/emosi', [EmosiController::class, 'store']);
