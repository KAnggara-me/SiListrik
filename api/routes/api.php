<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/', function () {
  abort(401);
});

// API Status
Route::get('/v1', [ApiController::class, 'status']);
