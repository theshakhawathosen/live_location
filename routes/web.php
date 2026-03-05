<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::class;

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::middleware('guest')->group(function () {

    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::get('/auth/google', [AuthController::class, 'login'])->name('login.redirect');
    Route::get('/auth/google/callback', [AuthController::class, 'loginCallback'])->name('login.callback');
});


// Student Routes
require __DIR__ . '/student.php';


// Driver Routes
require __DIR__ . '/driver.php';


// Admin Routes
require __DIR__ . '/admin.php';
