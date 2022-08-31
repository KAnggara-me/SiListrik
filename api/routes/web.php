<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('login');
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', function () {
  return view('login');
});

Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', function () {
  return view('register');
});
