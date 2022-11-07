<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\APIController;
use App\Http\Controllers\api\WebhookController;

// WebHook from API 
Route::post('/v1/webhooks', [WebhookController::class, 'index']);
Route::post('/v1/webhooks-debug', [WebhookController::class, 'debug']);

// User Status
Route::get('/v1/status/{username}/{token}', [APIController::class, 'userStatus']);

//post Data to Sensor
Route::get('/v1/data', [APIController::class, 'index']);
Route::get('/v1/data/{id}', [APIController::class, 'show']);
Route::post('/v1/data', [APIController::class, 'store']);

Route::get('/v1/img', [APIController::class, 'test']);
