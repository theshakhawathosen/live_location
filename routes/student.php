<?php

use App\Http\Controllers\Student\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('student.profile');
    Route::post('/update-profile', [DashboardController::class, 'updateprofile'])->name('student.updateprofile');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('student.settings');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('student.logout');
});
