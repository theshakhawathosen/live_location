<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AdminSetting;

class MaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {

        $setting = AdminSetting::first();

        if ($setting && $setting->maintenance) {

            if (!auth()->check() || auth()->user()->role !== 'admin') {
                return response()->view('errors.maintenance');
            }
        }

        return $next($request);
    }
}
