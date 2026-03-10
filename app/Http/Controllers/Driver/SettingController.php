<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\LiveLocation;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settings()
    {
        return view('driver.settings');
    }

    public function storeliveLocation(Request $request)
    {
        LiveLocation::updateOrCreate(
            [
                'vehicle_id' => $request->vehicle_id,
            ],
            [
                'lat' => $request->lat,
                'lng' => $request->lng,
                'user_id' => $request->user_id,
            ]
        );

        return response()->json(['status' => true]);
    }
}
