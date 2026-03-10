<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AdminSetting;

class AllowRegistration
{
    public function handle(Request $request, Closure $next)
    {
        $setting = AdminSetting::first();

        if ($setting && !$setting->allow_registration) {
            abort(403, 'New registrations are currently disabled.');
        }

        return $next($request);
    }
}
