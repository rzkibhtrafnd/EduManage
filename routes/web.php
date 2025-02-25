<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk masing-masing role
Route::middleware(['auth', 'role:1'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::resource('admin', AdminController::class)->except(['show']);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('pelajaran', PelajaranController::class);
    Route::resource('jadwal', JadwalController::class);
});

Route::middleware(['auth', 'role:2'])->group(function () {
    Route::get('/guru/dashboard', [DashboardController::class, 'guruIndex'])->name('guru.dashboard');
});

Route::middleware(['auth', 'role:3'])->group(function () {
    Route::get('/murid/dashboard', [DashboardController::class, 'muridIndex'])->name('murid.dashboard');
});

Route::middleware(['auth', 'role:4'])->group(function () {
    Route::get('/orangtua/dashboard', [DashboardController::class, 'orangTuaIndex'])->name('orangtua.dashboard');
});
