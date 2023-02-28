<?php

use App\Http\Controllers\Admin\AdLapanganController;
use App\Http\Controllers\Admin\AdTransaksiController;
use App\Http\Controllers\AuthController;

// controller admin
use App\Http\Controllers\Pemain\PeBookingController;
use App\Http\Controllers\Pemain\PemainController;
use App\Http\Controllers\Pemain\PePembayaranController;

// controller pemain
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'registerStore'])->name('register');
Route::post('login', [AuthController::class, 'loginStore'])->name('login');

// lapangan & fasilitas
Route::post('/lapangan/create', [AdLapanganController::class, 'lapanganAdd'])->name('lapanganAdd');
Route::put('/lapangan/update', [AdLapanganController::class, 'lapanganUpdate'])->name('lapanganUpdate');
Route::delete('/lapangan/delete/{id_lapangan}', [AdLapanganController::class, 'lapanganDelete'])->name('lapanganDelete');

// m transaksi
Route::post('/transaksi/create', [AdTransaksiController::class, 'transaksiAdd'])->name('transaksiAdd');
Route::put('/transaksi/update', [AdTransaksiController::class, 'transaksiUpdate'])->name('transaksiUpdate');
Route::delete('/transaksi/delete/{id_mtransaksi}', [AdTransaksiController::class, 'transaksiDelete'])->name('transaksiDelete');

// booking
Route::post('/booking/create', [PeBookingController::class, 'bookingAdd'])->name('bookingAdd');

// Pembayaran
Route::post('/pembayaran/create', [PePembayaranController::class, 'pembayarangAdd'])->name('pembayarangAdd');

Route::get('/booking/getTimeFree', [PeBookingController::class, 'bookingTimeFree'])->name('bookingTimeFree');
// check schedule
Route::post('check-schedule', [PemainController::class, 'checkSchedule']);
