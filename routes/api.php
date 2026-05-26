<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\DashboardController;
// routes/api.php



// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
 Route::apiResource('pelanggan', PelangganController::class);
  Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::apiResource('pelanggan', PelangganController::class);
    Route::apiResource('barang', BarangController::class);
    Route::apiResource('transaksi', TransaksiController::class);
// Protected routes (harus login)
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);

//     Route::get('/dashboard', [DashboardController::class, 'index']);

//     Route::apiResource('pelanggan', PelangganController::class);
//     Route::apiResource('barang', BarangController::class);
//     Route::apiResource('transaksi', TransaksiController::class);
// });
