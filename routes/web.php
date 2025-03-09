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
use App\Http\Controllers\MateriController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Middleware untuk masing-masing role
Route::middleware(['auth', 'role:1'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
    Route::resource('admin', AdminController::class)->except(['show']);
    Route::resource('guru', GuruController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('pelajaran', PelajaranController::class);
    Route::resource('jadwal', JadwalController::class);
});

Route::middleware(['auth', 'role:2'])->prefix('guru')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'guruIndex'])->name('guru.dashboard');
    Route::get('/jadwal', [JadwalController::class, 'guruIndex'])->name('guru.jadwal.index');
    Route::get('materi', [MateriController::class, 'indexPelajaran'])->name('guru.materi.index');
    Route::get('materi/{pelajaran}', [MateriController::class, 'materiByPelajaran'])->name('guru.materi.show');
    Route::get('materi/{pelajaran}/create', [MateriController::class, 'create'])->name('guru.materi.create');
    Route::post('materi/{pelajaran}', [MateriController::class, 'store'])->name('guru.materi.store');
    Route::get('materi/{materi}/edit', [MateriController::class, 'edit'])->name('guru.materi.edit');
    Route::put('materi/{materi}', [MateriController::class, 'update'])->name('guru.materi.update');
    Route::delete('materi/{materi}', [MateriController::class, 'destroy'])->name('guru.materi.destroy');
    Route::get('materi/{materi}/download', [MateriController::class, 'download'])->name('guru.materi.download');
});

Route::middleware(['auth', 'role:3'])->prefix('murid')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'muridIndex'])->name('murid.dashboard');
    Route::get('/jadwal', [JadwalController::class, 'muridIndex'])->name('murid.jadwal.index');
    Route::get('/materi', [MateriController::class, 'indexPelajaranMurid'])->name('murid.materi.index');
    Route::get('/materi/{pelajaran}', [MateriController::class, 'materiByPelajaranMurid'])->name('murid.materi.show');
    Route::get('/materi/download/{id}', [MateriController::class, 'download'])->name('murid.materi.download');
});

Route::middleware(['auth', 'role:4'])->prefix('orangtua')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'orangTuaIndex'])->name('orangtua.dashboard');
});
