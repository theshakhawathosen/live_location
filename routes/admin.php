<?php

use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::post('/update-profile', [DashboardController::class, 'updateprofile'])->name('admin.updateprofile');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('admin.settings');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('admin.logout');


    // Users 
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('/', 'index')->name('admin.user.index');
        Route::get('/create', 'create')->name('admin.user.create');
        Route::post('/store', 'store')->name('admin.user.store');
        Route::get('/edit/{id}', 'edit')->name('admin.user.edit');
        Route::put('/update/{id}', 'update')->name('admin.user.update');
        Route::get('/delete/{id}', 'delete')->name('admin.user.delete');
        Route::get('/toggle/{id}/{status}', 'toggle')->name('admin.user.toggle');
    });

    // Cars 
    Route::controller(CarController::class)->prefix('car')->group(function () {
        Route::get('/', 'index')->name('admin.car.index');
        Route::get('/create', 'create')->name('admin.car.create');
        Route::post('/store', 'store')->name('admin.car.store');
        Route::get('/edit/{id}', 'edit')->name('admin.car.edit');
        Route::put('/update/{id}', 'update')->name('admin.car.update');
        Route::get('/delete/{id}', 'delete')->name('admin.car.delete');
        Route::get('/toggle/{id}/{status}', 'toggle')->name('admin.car.toggle');
    });


    // System Routes
    Route::controller(SystemController::class)->prefix('system')->group(function () {
        Route::get('/refresh', 'refresh')->name('admin.system.refresh');
        Route::get('/maintenance', 'maintenance')->name('admin.system.maintenance');
        Route::get('/allow-registration', 'allow_registration')->name('admin.system.allow-registration');
    });
});
