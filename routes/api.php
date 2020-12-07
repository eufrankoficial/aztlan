<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->post('/devices/store', [\App\Http\Controllers\Api\DeviceController::class, 'store'])->name('api.device.store');
