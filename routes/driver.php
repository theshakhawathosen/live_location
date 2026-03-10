<?php

use App\Http\Controllers\Driver\DashboardController;
use App\Http\Controllers\Driver\SettingController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:driver', 'maintenance'])->prefix('driver')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('driver.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('driver.profile');
    Route::post('/update-profile', [DashboardController::class, 'updateprofile'])->name('driver.updateprofile');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('driver.logout');

    // Settings
    Route::get('/settings', [SettingController::class, 'settings'])->name('driver.settings');
    Route::post('/live-location', [SettingController::class, 'storeliveLocation'])->name('driver.store-live-location');
});
