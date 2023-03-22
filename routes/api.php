<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;

// Master Data
use App\Http\Controllers\Api\Master\MobilController;
use App\Http\Controllers\Api\Master\RentalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');

Route::middleware(['auth:api'])->group(function () {
    Route::get('/user', [LoginController::class, 'getUser']);

    Route::get('/mobil', [MobilController::class, 'getMobil'])->name('getMobil');
    Route::post('/mobil/create', [MobilController::class, 'createMobil'])->name('createMobil');
    Route::put('/mobil/update', [MobilController::class, 'updateMobil'])->name('updateMobil');
    Route::delete('/mobil/delete/{id_mobil}', [MobilController::class, 'deleteMobil'])->name('deleteMobil');

    // rental
    Route::post('/rental/create', [RentalController::class, 'rentalAdd'])->name('rentalAdd');
});
