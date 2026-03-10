<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use App\Models\DriverVehicle;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        return view('admin.profile');
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
        $setting = AdminSetting::first();
        return view('admin.settings', compact('setting'));
    }


    public function allDriver()
    {
        $drivers = DriverVehicle::with(['vehicle', 'driver'])->paginate(10);
        return view('admin.driver.all-driver', compact('drivers'));
    }

    public function assignDriver()
    {
        $drivers = User::where('status', 'active')
            ->where('role', 'driver')
            ->whereNotIn('id', function ($query) {
                $query->select('user_id')->from('driver_vehicle');
            })
            ->get();

        $vehicles = Vehicle::whereNotIn('id', function ($query) {
            $query->select('vehicle_id')->from('driver_vehicle');
        })->get();

        return view('admin.driver.assign-driver', compact('drivers', 'vehicles'));
    }

    public function storeDriver(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'required|exists:users,id',
        ]);

        DriverVehicle::create([
            'vehicle_id' => $request->vehicle_id,
            'user_id' => $request->driver_id,
        ]);

        return redirect()->back()->with('success', 'Driver assigned successfully');
    }
    public function deleteDriver($id)
    {
        $driver = DriverVehicle::findOrFail($id);
        $driver->delete();
        return back()->with('success', 'Driver Deleted!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
