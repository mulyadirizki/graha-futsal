<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Controller Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdLapanganController;
use App\Http\Controllers\Admin\AdTransaksiController;

// Controller Pemain
use App\http\Controllers\Pemain\PemainController;

// Controller Pemain
use App\http\Controllers\Pemilik\PemilikController;
use App\Http\Controllers\Pemain\PeBookingController;
use App\Http\Controllers\Pemain\PePembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/daftar', [AuthController::class, 'registerPage'])->name('register');
Route::post('daftar', [AuthController::class, 'registerStore'])->name('daftar');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login', [AuthController::class, 'loginStore'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'pemilik', 'middleware' => 'isPemilik'], function() {
    Route::get('/', [PemilikController::class, 'pemilikPage'])->name('pemilik');

    Route::get('/data-pemain', [PemilikController::class, 'pemilikPemainPage'])->name('pemilikPemain');
    Route::get('/data-booking', [PemilikController::class, 'pemilikBookingPage'])->name('pemilikBooking');
    Route::get('/data-transaksi', [PemilikController::class, 'pemilikTransaksiPage'])->name('pemilikTransaksi');
});

Route::group(['prefix' => 'admin', 'middleware' => 'isAdmin'], function() {
    Route::get('/', [AdminController::class, 'getAdminPage'])->name('admin');

    // lapangan
    Route::get('/lapangan', [AdLapanganController::class, 'index'])->name('lapangan');
    Route::get('/lapangan/create', [AdLapanganController::class, 'lapanganCreatePage'])->name('lapanganCreatePage');
    Route::post('/lapangan/create', [AdLapanganController::class, 'lapanganAdd'])->name('lapanganAdd');
    Route::get('/lapangan/update/{id_lapangan}', [AdLapanganController::class, 'lapanganUpdatePage'])->name('lapanganUpdatePage');
    Route::put('/lapangan/update', [AdLapanganController::class, 'lapanganUpdate'])->name('lapanganUpdate');
    Route::delete('/lapangan/delete/{id_lapangan}', [AdLapanganController::class, 'lapanganDelete'])->name('lapanganDelete');

    // lapangan
    Route::get('/rekening', [AdTransaksiController::class, 'index'])->name('rekening');
    Route::get('/rekening/create', [AdTransaksiController::class, 'rekeningCreatePage'])->name('rekeningCreatePage');
    Route::post('/transaksi/create', [AdTransaksiController::class, 'transaksiAdd'])->name('transaksiAdd');
    Route::get('/rekening/update/{id_mtransaksi}', [AdTransaksiController::class, 'rekeningUpdatePage'])->name('rekeningUpdatePage');
    Route::put('/transaksi/update', [AdTransaksiController::class, 'transaksiUpdate'])->name('transaksiUpdate');
    Route::delete('/transaksi/delete/{id_mtransaksi}', [AdTransaksiController::class, 'transaksiDelete'])->name('transaksiDelete');

    Route::get('/pemain', [AdminController::class, 'pemainPage'])->name('pemainAdmin');
    Route::get('/booking', [AdminController::class, 'bookingPage'])->name('booking');
    Route::get('/transaksi', [AdminController::class, 'transaksiPage'])->name('transaksi');
});

Route::group(['prefix' => 'id/u/pemain', 'middleware' => 'isPemain'], function() {
    Route::get('/', [PemainController::class, 'pemainPage'])->name('pemain');

    Route::get('/booking', [PemainController::class, 'pemainBookingDetail'])->name('pemainBookingDetail');
    Route::get('/booking/store/{id_lapangan}', [PemainController::class, 'pemainBookingDate'])->name('pemainBookingDate');
    Route::post('/booking/create', [PeBookingController::class, 'bookingAdd'])->name('bookingAdd');

    Route::get('/pembayaran', [PemainController::class, 'pemainPembayaranBooking'])->name('pemainPembayaranBooking');
    Route::get('/pembayaran-konfirmasi/{id_booking}', [PemainController::class, 'pemainPembayaranKonfirmasi'])->name('pemainPembayaranKonfirmasi');
    Route::post('/pembayaran/create', [PePembayaranController::class, 'pembayarangAdd'])->name('pembayarangAdd');
});
