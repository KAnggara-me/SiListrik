<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\DeviceController;
use App\Http\Controllers\api\WebhookController;

Route::get('/', function () {
  abort(401);
});

// API Version
Route::get('/v1', [ApiController::class, 'apiVersion']);
Route::post('/v1', [ApiController::class, 'apiVersion']);

// Devices API
Route::post('/v1/devices', [DeviceController::class, 'deviceAdd']);
Route::get('/v1/devices', [DeviceController::class, 'devicelist']);
// Devices by ID
Route::get('/v1/qr', [ApiController::class, 'qrCode']);

Route::get('/v1/devices/{id}', [DeviceController::class, 'deviceId']);
Route::post('/v1/devices/{id}', [DeviceController::class, 'deviceId']);
Route::delete('/v1/devices/{id}', [DeviceController::class, 'deleteDevice']);

Route::delete('/v1/webhook', [WebhookController::class, 'deleteDevice']);
