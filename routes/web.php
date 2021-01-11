<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MenuSystemController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DeviceChartController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\UserGroupController;

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


    Route::prefix('menus')->name('menu.')->group( function() {
        Route::get('/', [MenuSystemController::class, 'index'])->name('index');
        Route::get('/create', [MenuSystemController::class, 'create'])->name('create');
        Route::post('/create', [MenuSystemController::class, 'store'])->name('store');
        Route::get('/edit/{menu}', [MenuSystemController::class, 'show'])->name('detail');
        Route::post('/edit/{menu}', [MenuSystemController::class, 'update'])->name('update');
        Route::get('/delete/{menu}', [MenuSystemController::class, 'destroy'])->name('delete');
    });

    Route::prefix('devices')->name('device.')->group( function() {
        Route::get('/', [DeviceController::class, 'index'])->name('index');
        Route::get('/create', [DeviceController::class, 'create'])->name('create');
        Route::post('/create', [DeviceController::class, 'store'])->name('store');
        Route::get('/{device}', [DeviceController::class, 'show'])->name('detail');
		Route::post('/{device}', [DeviceController::class, 'update'])->name('update');
		Route::post('/{device}/save-chart-config', [DeviceChartController::class, 'save'])->name('save.chart.config');
        Route::post('/{device?}/{field}', [FieldController::class, 'update'])->name('save');
    });

    Route::prefix('report')->name('report.')->group(function () {
       Route::get('/device/{device}', [ReportController::class, 'exportDeviceHistory'])->name('device');
    });

    Route::prefix('users')->name('user.')->group( function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/exist', [UserController::class, 'exist'])->name('exist');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('detail');
        Route::post('/edit/{user}', [UserController::class, 'update'])->name('update');
        Route::get('/delete/{user}', [UserController::class, 'destroy'])->name('delete');
    });

    Route::prefix('companies')->name('company.')->group( function() {
        Route::get('/', [CompanyController::class, 'index'])->name('index');
        Route::get('/create', [CompanyController::class, 'create'])->name('create');
        Route::post('/create', [CompanyController::class, 'store'])->name('store');
        Route::get('/edit/{company}', [CompanyController::class, 'show'])->name('detail');
        Route::post('/edit/{company}', [CompanyController::class, 'update'])->name('update');
        Route::get('/delete/{company}', [CompanyController::class, 'destroy'])->name('delete');
    });

    Route::prefix('fields')->name('field.')->group( function() {
        Route::get('/', [FieldController::class, 'index'])->name('index');
        Route::get('/{device?}', [FieldController::class, 'showField'])->name('detail.device');
        Route::post('/{device?}/{field}', [FieldController::class, 'update'])->name('save');
        Route::get('/show/{device?}', [FieldController::class, 'show'])->name('device.detail');
        Route::post('/show/{device}/{field}', [FieldController::class, 'update'])->name('device.save');
	});


	Route::prefix('user-groups')->name('user.groups.')->group(function () {
		Route::get('/', [UserGroupController::class, 'index'])->name('index');
		Route::get('/add', [UserGroupController::class, 'create'])->name('add');
		Route::post('/add', [UserGroupController::class, 'store'])->name('store');
		Route::get('/{group}/edit', [UserGroupController::class, 'edit'])->name('detail');
		Route::post('/{group}/edit', [UserGroupController::class, 'update'])->name('save');
	});

});
