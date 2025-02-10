<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;

Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:20,1'); 
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:20,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::post('/kelas', [KelasController::class, 'store']);
    Route::get('/kelas/{id}', [KelasController::class, 'show']);
    Route::put('/kelas/{id}', [KelasController::class, 'update']);
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy']);
    Route::post('/kelas/{class_id}/add-student/{student_id}', [KelasController::class, 'addStudent']);
    Route::delete('/kelas/{class_id}/remove-student/{student_id}', [KelasController::class, 'removeStudent']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
