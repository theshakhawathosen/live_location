<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate([
            'email' => $googleUser->email,
        ], [
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'photo' => $googleUser->getAvatar(),
            'password' => Hash::make(uniqid()),
        ]);
        Auth::login($user);

        $user->forceFill(['last_login' => now()])->save();

        if (Auth::check()) {
            return redirect_based_on_role();
        } else {
            return "Login Failed!";
        }
    }
}
