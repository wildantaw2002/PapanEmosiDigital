<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmosiController;

Route::post('/emosi', [EmosiController::class, 'store']);
Route::get('/emosi', [EmosiController::class, 'index']);
Route::get('/emosi/statistik', [EmosiController::class, 'statistik']);
