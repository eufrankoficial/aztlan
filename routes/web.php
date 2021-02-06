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
use App\Http\Controllers\DeviceReportController;

Route::middleware('guest')->namespace('Auth')->group(function() {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate.post');
    Route::get('/revover-password', [RecoverPasswordController::class, 'index'])->name('recoverpass.index');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('resetpass.index');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->namespace('Controllers')->group(function() {
    Route::get('/home', [DashboardController::class, 'index'])->middleware(['can:dashboard.index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['can:dashboard.index'])->name('dashboard.index');


    Route::prefix('menus')->name('menu.')->group(function() {
        Route::get('/', [MenuSystemController::class, 'index'])->middleware(['can:menu.index'])->name('index');
        Route::get('/create', [MenuSystemController::class, 'create'])->middleware(['can:menu.create'])->name('create');
        Route::post('/create', [MenuSystemController::class, 'store'])->middleware(['can:menu.create'])->name('store');
        Route::get('/edit/{menu}', [MenuSystemController::class, 'show'])->middleware(['can:menu.detail'])->name('detail');
        Route::post('/edit/{menu}', [MenuSystemController::class, 'update'])->middleware(['can:menu.update'])->name('update');
        Route::get('/delete/{menu}', [MenuSystemController::class, 'destroy'])->middleware(['can:menu.delete'])->name('delete');
    });

    Route::prefix('devices')->name('device.')->group( function() {
        Route::get('/', [DeviceController::class, 'index'])->middleware(['can:device.index'])->name('index');
        Route::get('/create', [DeviceController::class, 'create'])->middleware(['can:device.create'])->name('create');
        Route::post('/create', [DeviceController::class, 'store'])->middleware(['can:device.create'])->name('store');
        Route::get('/{device}', [DeviceController::class, 'show'])->middleware(['can:device.detail'])->name('detail');
		Route::post('/{device}', [DeviceController::class, 'update'])->middleware(['can:device.update'])->name('update');
		Route::post('/{device?}/save-chart-config', [DeviceChartController::class, 'save'])->middleware(['can:config.device.chart'])->name('save.chart.config');
		Route::post('/{device?}/chart-data', [DeviceChartController::class, 'getDataChart'])->middleware(['can:config.device.chart'])->name('get.chart');
		Route::post('/{device}/report', [DeviceReportController::class, 'generate'])->middleware(['can:config.device.chart'])->name('post.report');
        Route::post('/{device?}/{field}', [FieldController::class, 'update'])->middleware(['can:device.update'])->name('save');
    });

    Route::prefix('report')->name('report.')->group(function () {
       Route::get('/device/{device}', [ReportController::class, 'exportDeviceHistory'])->name('device');
    });

    Route::prefix('users')->name('user.')->group( function() {
        Route::get('/', [UserController::class, 'index'])->middleware(['can:users.index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->middleware(['can:users.create'])->name('create');
        Route::post('/exist', [UserController::class, 'exist'])->name('exist');
        Route::post('/store', [UserController::class, 'store'])->middleware(['can:users.create'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->middleware(['can:users.detail'])->name('detail');
        Route::post('/edit/{user}', [UserController::class, 'update'])->middleware(['can:users.update'])->name('update');
        Route::get('/delete/{user}', [UserController::class, 'destroy'])->middleware(['can:users.delete'])->name('delete');
    });

    Route::prefix('companies')->name('company.')->group( function() {
        Route::get('/', [CompanyController::class, 'index'])->middleware(['can:company.index'])->name('index');
        Route::get('/create', [CompanyController::class, 'create'])->middleware(['can:company.create'])->name('create');
        Route::post('/create', [CompanyController::class, 'store'])->middleware(['can:company.create'])->name('store');
		Route::post('/find-company', [CompanyController::class, 'findBy'])->middleware(['can:company.index'])->name('find');
        Route::get('/edit/{company}', [CompanyController::class, 'show'])->middleware(['can:company.detail'])->name('detail');
        Route::post('/edit/{company}', [CompanyController::class, 'update'])->middleware(['can:company.update'])->name('update');
        Route::get('/delete/{company}', [CompanyController::class, 'destroy'])->middleware(['can:company.delete'])->name('delete');

    });

    Route::prefix('fields')->name('field.')->group( function() {
        Route::get('/', [FieldController::class, 'index'])->name('index');
        Route::get('/{device?}', [FieldController::class, 'showField'])->name('detail.device');
        Route::post('/{device?}/{field?}', [FieldController::class, 'update'])->name('save');
        Route::get('/show/{device?}', [FieldController::class, 'show'])->name('device.detail');
        Route::post('/show/{device}/{field}', [FieldController::class, 'update'])->name('device.save');
	});


	Route::prefix('user-groups')->name('user.groups.')->group(function () {
		Route::get('/', [UserGroupController::class, 'index'])->middleware(['can:user.groups.index'])->name('index');
		Route::get('/add', [UserGroupController::class, 'create'])->middleware(['can:user.groups.add'])->name('add');
		Route::post('/add', [UserGroupController::class, 'store'])->middleware(['can:user.groups.add'])->name('store');
		Route::get('/{group}/edit', [UserGroupController::class, 'edit'])->middleware(['can:user.groups.detail'])->name('detail');
		Route::post('/{group}/edit', [UserGroupController::class, 'update'])->middleware(['can:user.groups.update'])->name('save');
		Route::get('/{group}/delete', [UserGroupController::class, 'destroy'])->middleware(['can:user.groups.delete'])->name('delete');
	});

});
