<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

// Controller Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdLapanganController;
use App\Http\Controllers\Admin\AdTransaksiController;
use App\Http\Controllers\Admin\AdFasilitasController;

// Controller Pemain
use App\Http\Controllers\Pemain\PemainController;

// Controller Pemain
use App\Http\Controllers\Pemilik\PemilikController;
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
    return view('home');
})->name('home');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/daftar', [AuthController::class, 'registerPage'])->name('register');
Route::post('daftar', [AuthController::class, 'registerStore'])->name('daftar');
Route::get('/status-verify/{id}', [AuthController::class, 'statusVerify'])->name('statusVerify');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('login', [AuthController::class, 'loginStore'])->name('loginStore');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('kontak-kami', [HomeController::class, 'contact'])->name('contact');

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

    // lapangan
    Route::get('/fasilitas', [AdFasilitasController::class, 'index'])->name('fasilitas');
    Route::get('/fasilitas/create', [AdFasilitasController::class, 'fasilitasCreatePage'])->name('fasilitasCreatePage');
    Route::post('/fasilitas/create', [AdFasilitasController::class, 'fasilitasAdd'])->name('fasilitasAdd');
    Route::get('/fasilitas/update/{id_mfasilitas}', [AdFasilitasController::class, 'fasilitasUpdatePage'])->name('fasilitasUpdatePage');
    Route::put('/fasilitas/update', [AdFasilitasController::class, 'fasilitasUpdate'])->name('fasilitasUpdate');
    Route::delete('/fasilitas/delete/{id_mfasilitas}', [AdFasilitasController::class, 'fasilitasDelete'])->name('fasilitasDelete');

    Route::get('/pemain/new-register', [AdminController::class, 'pemainAdminNew'])->name('pemainAdminNew');
    Route::post('/verify-user/{id}', [AdminController::class, 'verifyUser'])->name('verifyUser');
    Route::get('/pemain', [AdminController::class, 'pemainPage'])->name('pemainAdmin');
    Route::get('/booking', [AdminController::class, 'bookingPage'])->name('booking');
    Route::get('/transaksi', [AdminController::class, 'transaksiPage'])->name('transaksi');

    Route::get('/booking-lapangan', [AdminController::class, 'bookingLapangan'])->name('bookingLapangan');
    Route::get('/count-date', [AdminController::class, 'getCountDate'])->name('getCountDate');
});

Route::group(['prefix' => 'id/u/pemain', 'middleware' => 'isPemain'], function() {
    Route::get('/', [PemainController::class, 'pemainPage'])->name('pemain');

    Route::get('/booking', [PemainController::class, 'pemainBookingDetail'])->name('pemainBookingDetail');
    Route::get('/detail-fasilitas/{id}', [PemainController::class, 'pemainFasilitasDetail'])->name('pemainFasilitasDetail');
    Route::get('/booking/store/{id_lapangan}', [PemainController::class, 'pemainBookingDate'])->name('pemainBookingDate');
    Route::post('/booking/create', [PeBookingController::class, 'bookingAdd'])->name('bookingAdd');

    Route::get('/pembayaran', [PemainController::class, 'pemainPembayaranBooking'])->name('pemainPembayaranBooking');
    Route::get('/pembayaran-konfirmasi/{id_booking}', [PemainController::class, 'pemainPembayaranKonfirmasi'])->name('pemainPembayaranKonfirmasi');
    Route::post('/pembayaran/create', [PePembayaranController::class, 'pembayarangAdd'])->name('pembayarangAdd');
    Route::get('/pembayaran-bukti/{id_booking}', [PemainController::class, 'pemainPembayaranBukti'])->name('pemainPembayaranBukti');
});
