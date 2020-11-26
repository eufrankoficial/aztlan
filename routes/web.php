<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;

Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate.post');
    Route::get('/revover-password', [RecoverPasswordController::class, 'index'])->name('recoverpass.index');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('resetpass.index');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->namespace('Controllers')->group(function() {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/device-detail', [DeviceController::class, 'show'])->name('device.detail');
});
