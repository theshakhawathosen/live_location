<?php

use App\Http\Controllers\Driver\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:driver'])->prefix('driver')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('driver.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('driver.profile');
    Route::post('/update-profile', [DashboardController::class, 'updateprofile'])->name('driver.updateprofile');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('driver.settings');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('driver.logout');
});
