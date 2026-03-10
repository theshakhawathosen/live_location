<?php

use App\Http\Controllers\Student\DashboardController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::middleware(['auth', 'role:student', 'maintenance'])->prefix('student')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('student.profile');
    Route::post('/update-profile', [DashboardController::class, 'updateprofile'])->name('student.updateprofile');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('student.settings');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('student.logout');

    // Change State of Option
    Route::post('/change-state', [DashboardController::class, 'changeState'])->name('student.change.state');
    // Save My Location
    Route::post('/save-location', [DashboardController::class, 'saveLocation'])->name('student.save.location');
    Route::get('/get-vehicles-data/{id}', [DashboardController::class, 'getVehiclesData'])->name('student.get.vehicles');
});
