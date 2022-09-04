<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::get('/', [AuthController::class, 'login'])->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', function () {
  return view('auth.register');
})->middleware('guest');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::get('/status', [StatusController::class, 'index']);

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/setting', [HomeController::class, 'setting'])->middleware('auth');
Route::get('/notif', [HomeController::class, 'notif'])->middleware('auth');
Route::get('/logs', [HomeController::class, 'logs'])->middleware('auth');

// Route::get('/add', [HomeController::class, 'device'])->middleware('auth');
