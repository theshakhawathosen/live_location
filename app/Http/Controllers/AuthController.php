<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

        $photoUrl = $googleUser->getAvatar();
        $photoPath = null;

        if ($photoUrl) {

            // image download
            $response = Http::get($photoUrl);

            if ($response->successful()) {

                $fileName = Str::random(20) . '.png';
                $path = "user/" . $fileName;

                // save to storage/app/public/user
                Storage::disk('public')->put($path, $response->body());

                // generate public url
                $photoPath = asset('storage/' . $path);
            }
        }

        $user = User::firstOrCreate(
            [
                'email' => $googleUser->email,
            ],
            [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'photo' => $photoPath,
                'password' => Hash::make(uniqid()),
            ]
        );

        Auth::login($user);

        $user->forceFill(['last_login' => now()])->save();

        if (Auth::check()) {
            return redirect_based_on_role();
        }

        return "Login Failed!";
    }
}
