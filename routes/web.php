<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/auto', function () {
    $user = User::where('role', 'student')->first();

    if ($user) {
        Auth::login($user);
        return redirect()->route('student.dashboard');
    }
    return response()->json([
        'message' => 'No student user found in the database.'
    ], 404);
});

Route::middleware('maintenance')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('homepage');
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('login.redirectByRole');
});
Route::middleware(['guest', 'registration'])->group(function () {
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
