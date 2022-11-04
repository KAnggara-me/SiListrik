<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SettingController;

Route::view('/', 'auth.login')->middleware('guest');
Route::view('/login', 'auth.login')->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/register', function () {
  return view('auth.register');
})->middleware('guest');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->middleware(['auth',]);
Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::get('/qr', [HomeController::class, 'qrCode']);
Route::get('/status', [StatusController::class, 'status']);
Route::get('/deviceadd', [HomeController::class, 'deviceadd'])->middleware(['auth']);

// OK
Route::get('/home', [HomeController::class, 'index'])->middleware(['auth', 'connected'])->name('home');
Route::get('/connect', [HomeController::class, 'connect'])->middleware(['auth'])->name('connect');
Route::get('/logs', [HomeController::class, 'logs'])->middleware(['auth', 'connected']);
Route::get('/notif', [HomeController::class, 'notif'])->middleware(['auth', 'connected']);
Route::get('/bot', [HomeController::class, 'bot'])->middleware(['auth', 'connected']);


// Setting
Route::get('/setting', [SettingController::class, 'edit'])->middleware(['auth', 'connected']);
Route::post('/setting', [SettingController::class, 'update'])->middleware(['auth', 'connected']);
