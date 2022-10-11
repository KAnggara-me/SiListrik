<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->middleware('guest');
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/register', [AuthController::class, 'registerView'])->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth',]);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::get('/qr', [HomeController::class, 'qrCode']);
Route::get('/status', [StatusController::class, 'status']);
Route::get('/deviceadd', [HomeController::class, 'deviceadd'])->middleware(['auth']);

Route::get('/logs', [HomeController::class, 'logs'])->middleware(['auth', 'connected']);

Route::get('/notif', [HomeController::class, 'notif'])->middleware(['auth', 'connected']);
Route::get('/setting', [HomeController::class, 'setting'])->middleware(['auth', 'connected']);

// OK
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'connected'])->name('home');

Route::get('/connect', [HomeController::class, 'connect'])->middleware(['auth'])->name('connect');
