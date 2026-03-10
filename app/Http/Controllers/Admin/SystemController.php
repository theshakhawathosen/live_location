<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SystemController extends Controller
{
    public function refresh()
    {
        Artisan::call('optimize:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');
        return "System Optimized!";
    }

    public function maintenance(Request $request)
    {
        $setting = AdminSetting::first();
        if ($request->mode === "enable") {
            $setting->maintenance = 1;
        } else {
            $setting->maintenance = 0;
        }
        $setting->save();

        return "Maintenance mode " . $request->mode;
    }

    public function allow_registration(Request $request)
    {
        $setting = AdminSetting::first();

        if ($request->mode === "enable") {
            $setting->allow_registration = 1;
        } else {
            $setting->allow_registration = 0;
        }
        $setting->save();

        return "Allow registration " . $request->mode;
    }
}
