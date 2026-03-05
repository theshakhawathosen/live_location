<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller

{

    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function profile()
    {
        return view('student.profile');
    }

    public function updateprofile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'phone' => 'nullable|numeric|max_digits:11'
        ]);


        if ($request->hasFile('photo')) {

            // Delete the Previous one
            if (Auth::user()->photo !== null) {
                $relativepath = Str::after(Auth::user()->photo, '/storage/');
                if (Storage::disk('public')->exists($relativepath)) {
                    Storage::disk('public')->delete($relativepath);
                }
            }

            $path = $request->file('photo')->store('user', 'public');
            $filepath = asset(env('PUBLIC_PATH') . 'storage/' . $path);
            $validatedData['photo'] = $filepath;
        }

        Auth::user()->update($validatedData);

        return back()->with('success', 'Profile Updated!');
    }

    public function settings()
    {
        return view('student.settings');
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
