<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;
use App\Http\Controllers\api\WebhookController;

// WebHook from API 
Route::post('/v1/webhooks', [WebhookController::class, 'index']);

// Data from Sensor
Route::post('/v1/data', [ApiController::class, 'data']);

// User Status
Route::get('/v1/status/{username}/{token}', [ApiController::class, 'userStatus']);
