<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate.post');
    Route::get('/revover-password', [RecoverPasswordController::class, 'index'])->name('recoverpass.index');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('resetpass.index');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->namespace('Controllers')->group(function() {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::prefix('devices')->name('device.')->group( function() {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::get('/create', [DeviceController::class, 'create'])->name('create');
        Route::get('/{device}', [DeviceController::class, 'show'])->name('detail');
    });

    Route::prefix('users')->name('user.')->group( function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/exist', [UserController::class, 'exist'])->name('exist');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('detail');
        Route::post('/edit/{user}', [UserController::class, 'update'])->name('update');

    });
});
