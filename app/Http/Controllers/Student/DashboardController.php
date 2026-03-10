<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller

{

    public function dashboard()
    {
        // return view('student.dashboard');
        return view('student');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function changeState(Request $request)
    {
        $column = $request->column_name;
        if ($column == 'role') {
            return response()->json([
                'message' => "Don't try to be smarter! LOL :)"
            ]);
        } else {
            if (Auth::id() == $request->user_id) {
                $user = Auth::user();
                $user->$column = $request->status;
                $user->save();

                return response()->json([
                    'message' => "Status Changes!"
                ]);
            } else {
                return response()->json([
                    'message' => "Unauthorize Access!"
                ]);
            }
        }
    }

    public function saveLocation(Request $request)
    {
        if (Auth::id() == $request->user_id) {
            $user = Auth::user();
            $user->lat = $request->lat;
            $user->lng = $request->lng;
            $user->save();
        } else {
            return "Unauthorize Access!";
        }
    }


    /*
      {
        "id": "bus_01",
        "type": "bus",
        "name": "Bus - Route 1",
        "driver": "Karim Uddin",
        "route": "Mirpur → DIU Campus",
        "plate": "Dhaka Metro-GA 1234",
        "lat": 23.8759,
        "lng": 90.3863,
        "status": "running"
    }
    */

    public function getVehiclesData($id)
    {
        if (Auth::id() == $id) {

            $buses = Car::with('user')
                ->where('type', 'bus')
                ->get();

            $data = $buses->map(function ($bus) {

                return [
                    "id" => "bus_" . $bus->id,
                    "type" => $bus->type,
                    "name" => $bus->name,
                    "driver" => $bus->user->name,
                    "route" => "-", // যদি আলাদা route table না থাকে
                    "plate" => $bus->number_plate,
                    "lat" => $bus->user->lat,
                    "lng" => $bus->user->lng,
                    "status" => $bus->status ? "running" : "stopped",
                ];
            });

            return response()->json($data);
        } else {
            return response()->json([
                'message' => "Don't try to hack!"
            ]);
        }
    }
}
