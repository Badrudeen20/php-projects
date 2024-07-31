<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthCheck;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['isAuth'])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'register']);
});




Route::middleware(['auth'])->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/update/{id}', [UserController::class, 'update']);
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/upload', [AdminController::class, 'upload'])->name('users.upload');
    Route::get('/download', [AdminController::class, 'download'])->name('users.download');
});