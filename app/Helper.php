<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('redirect_based_on_role')) {
    function redirect_based_on_role()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Login Success!');
        } elseif (Auth::user()->role == 'driver') {
            return redirect()->route('driver.dashboard')->with('success', 'Login Success!');
        } else {
            return redirect()->route('student.dashboard')->with('success', 'Login Success!');
        }
    }
}
