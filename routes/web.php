<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\DokterController;

use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Berikut adalah definisi route utama aplikasi.
| Setiap role (admin, dokter, pasien) memiliki route dashboard masing-masing.
|
*/

// ====== AUTHENTICATION ======
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====== ADMIN ROUTES ======
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Resource controllers untuk admin
        Route::resource('polis', PoliController::class);
        Route::resource('dokter', DokterController::class);
        // Route::resource('pasien', PasienController::class);
        // Route::resource('obat', ObatController::class);
    });

// ====== DOKTER ROUTES ======
Route::middleware(['auth', 'role:dokter'])
    ->prefix('dokter')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('dokter.dashboard');
        })->name('dokter.dashboard');
    });

// ====== PASIEN ROUTES ======
Route::middleware(['auth', 'role:pasien'])
    ->prefix('pasien')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('pasien.dashboard');
        })->name('pasien.dashboard');
    });
