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
        $column = $request->label;
        if ($column == 'role') {
            return response()->json([
                'status' => 'error',
                'message' => "Don't try to be smarter! LOL :)"
            ]);
        } else {
            if (Auth::id() == $request->user_id) {
                $user = Auth::user();
                $user->$column = $request->status;
                $user->save();

                $status = $request->status == 1 ? 'ON' : 'OFF';
                $online = $request->status == 1 ? 'Online' : 'Offline';

                $message = '';
                switch ($column) {
                    case 'show_online':
                        $message = 'You are ' . $online . ' now!';
                        break;

                    default:
                        $message = 'Status Changed!';
                        break;
                }

                return response()->json([
                    'status' => 'success',
                    'message' => $message,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => "Unauthorize Access!"
                ]);
            }
        }
    }

    public function saveLocation(Request $request)
    {
        $user = Auth::user();
        $user->lat = $request->lat;
        $user->lng = $request->lng;
        $user->save();

        return $user;
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
