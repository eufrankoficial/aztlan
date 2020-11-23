<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;

Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
});
