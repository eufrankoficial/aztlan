<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::get('/revover-password', [RecoverPasswordController::class, 'index'])->name('recoverpass.index');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('resetpass.index');
});
