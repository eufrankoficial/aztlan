<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RecoverPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeviceChartController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceReportController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\MenuSystemController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->namespace('Auth')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate.post');
    Route::get('/revover-password', [RecoverPasswordController::class, 'index'])->name('recoverpass.index');
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('resetpass.index');
});

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::middleware('auth')->namespace('Controllers')->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::prefix('upload')->name('upload.')->group(function () {
        Route::post('/', [UploadController::class, 'upload'])->name('file');
    });

    Route::prefix('menus')->name('menu.')->group(function () {
        Route::get('/', [MenuSystemController::class, 'index'])->middleware(['has_permission_to:menu.index'])->name('index');
        Route::get('/create', [MenuSystemController::class, 'create'])->middleware(['has_permission_to:menu.create'])->name('create');
        Route::post('/create', [MenuSystemController::class, 'store'])->middleware(['has_permission_to:menu.create'])->name('store');
        Route::get('/edit/{menu}', [MenuSystemController::class, 'show'])->middleware(['has_permission_to:menu.detail'])->name('detail');
        Route::post('/edit/{menu}', [MenuSystemController::class, 'update'])->middleware(['has_permission_to:menu.update'])->name('update');
        Route::get('/delete/{menu}', [MenuSystemController::class, 'destroy'])->middleware(['has_permission_to:menu.delete'])->name('delete');
    });

    Route::prefix('devices')->name('device.')->group(function () {
        Route::get('/', [DeviceController::class, 'index'])->middleware(['has_permission_to:device.index'])->name('index');
        Route::get('/create', [DeviceController::class, 'create'])->middleware(['has_permission_to:device.create'])->name('create');
        Route::post('/create', [DeviceController::class, 'store'])->middleware(['has_permission_to:device.create'])->name('store');
        Route::get('/{device}', [DeviceController::class, 'show'])->middleware(['has_permission_to:device.detail'])->name('detail');
        Route::post('/{device}', [DeviceController::class, 'update'])->middleware(['has_permission_to:device.update'])->name('update');
        Route::post('/{device?}/save-chart-config', [DeviceChartController::class, 'save'])->middleware(['has_permission_to:config.device.chart'])->name('save.chart.config');
        Route::post('/{device?}/chart-data', [DeviceChartController::class, 'getDataChart'])->middleware(['has_permission_to:config.device.chart'])->name('get.chart');
        Route::post('/{device}/report', [DeviceReportController::class, 'generate'])->middleware(['has_permission_to:config.device.chart'])->name('post.report');
        Route::post('/{device?}/{field}', [FieldController::class, 'update'])->middleware(['has_permission_to:device.update'])->name('save');
    });

    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/device/{device}', [ReportController::class, 'exportDeviceHistory'])->name('device');
    });

    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->middleware(['has_permission_to:users.index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->middleware(['has_permission_to:users.create'])->name('create');
        Route::post('/exist', [UserController::class, 'exist'])->name('exist');
        Route::post('/store', [UserController::class, 'store'])->middleware(['has_permission_to:users.create'])->name('store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->middleware(['has_permission_to:users.detail'])->name('detail');
        Route::post('/edit/{user}', [UserController::class, 'update'])->middleware(['has_permission_to:users.update'])->name('update');
        Route::get('/delete/{user}', [UserController::class, 'destroy'])->middleware(['has_permission_to:users.delete'])->name('delete');
    });

    Route::prefix('companies')->name('company.')->group(function () {
        Route::get('/', [CompanyController::class, 'index'])->middleware(['has_permission_to:company.index'])->name('index');
        Route::get('/create', [CompanyController::class, 'create'])->middleware(['has_permission_to:company.create'])->name('create');
        Route::post('/create', [CompanyController::class, 'store'])->middleware(['has_permission_to:company.create'])->name('store');
        Route::post('/find-company', [CompanyController::class, 'findBy'])->middleware(['has_permission_to:company.index'])->name('find');
        Route::get('/edit/{company}', [CompanyController::class, 'show'])->middleware(['has_permission_to:company.detail'])->name('detail');
        Route::post('/edit/{company}', [CompanyController::class, 'update'])->middleware(['has_permission_to:company.update'])->name('update');
        Route::get('/delete/{company}', [CompanyController::class, 'destroy'])->middleware(['has_permission_to:company.delete'])->name('delete');
    });

    Route::prefix('fields')->name('field.')->group(function () {
        Route::get('/', [FieldController::class, 'index'])->name('index');
        Route::get('/{device?}', [FieldController::class, 'showField'])->name('detail.device');
        Route::post('/{device?}/{field?}', [FieldController::class, 'update'])->name('save');
        Route::get('/show/{device?}', [FieldController::class, 'show'])->name('device.detail');
        Route::post('/show/{device}/{field}', [FieldController::class, 'update'])->name('device.save');
    });

    Route::prefix('user-groups')->name('user.groups.')->group(function () {
        Route::get('/', [UserGroupController::class, 'index'])->middleware(['has_permission_to:user.groups.index'])->name('index');
        Route::get('/add', [UserGroupController::class, 'create'])->middleware(['has_permission_to:user.groups.add'])->name('add');
        Route::post('/add', [UserGroupController::class, 'store'])->middleware(['has_permission_to:user.groups.add'])->name('store');
        Route::get('/{group}/edit', [UserGroupController::class, 'edit'])->middleware(['has_permission_to:user.groups.detail'])->name('detail');
        Route::post('/{group}/edit', [UserGroupController::class, 'update'])->middleware(['has_permission_to:user.groups.update'])->name('save');
        Route::get('/{group}/delete', [UserGroupController::class, 'destroy'])->middleware(['has_permission_to:user.groups.delete'])->name('delete');
    });
});
