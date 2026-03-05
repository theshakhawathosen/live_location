<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/update-profile', [DashboardController::class, 'updateprofile'])->name('admin.updateprofile');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');


    // All Users
    Route::resource('user', UserController::class);
    Route::get('toggle-status/{id}/{status}', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');
});
