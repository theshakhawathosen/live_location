<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of all vehicles with search & filter support.
     */
    public function index(Request $request)
    {
        $cars = Car::latest()->paginate(20);
        return view('admin.cars.cars', compact('cars'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        $drivers = User::where('status', 1)->where('role', 'driver')->get();
        return view('admin.cars.create', compact('drivers'));
    }

    /**
     * Store a newly created vehicle in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'         => ['required', 'string', 'max:100', 'min:2'],
                'number_plate' => ['nullable', 'string', 'max:20', 'unique:cars,number_plate'],
                'type'         => ['required', 'in:bus,hiace'],
                'capacity'     => ['required', 'integer', 'min:1', 'max:500'],
                'status'    => ['required'],
                'user_id' => ['required', 'exists:users,id', 'unique:cars,user_id'],
            ],
            [
                'name.required'          => 'Car name is required.',
                'name.min'               => 'Car name must be at least 2 characters.',
                'number_plate.unique'    => 'This number plate is already registered.',
                'type.required'          => 'Please select a Car type.',
                'type.in'                => 'Invalid Car type selected.',
                'capacity.required'      => 'Seating capacity is required.',
                'capacity.min'           => 'Capacity must be at least 1.',
                'capacity.max'           => 'Capacity cannot exceed 500.',
                'user_id.required'       => 'Please select a driver.',
                'user_id.exists'         => 'Selected driver does not exist.',
                'user_id.unique'         => 'This driver already assigned with a car'
            ]
        );

        Car::create($validated);

        return redirect()
            ->route('admin.car.index')
            ->with('success', "Vehicle \"{$validated['name']}\" has been added successfully.");
    }

    /**
     * Show the form for editing a vehicle.
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $drivers = User::where('status', 1)->where('role', 'driver')->get();
        return view('admin.cars.edit', compact('car', 'drivers'));
    }

    /**
     * Update the specified vehicle in the database.
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        $validated = $request->validate(
            [
                'name'         => ['required', 'string', 'max:100', 'min:2'],
                'number_plate' => ['nullable', 'string', 'max:20', 'unique:cars,number_plate,' . $id],
                'type'         => ['required', 'in:bus,hiace'],
                'capacity'     => ['required', 'integer', 'min:1', 'max:500'],
                'status'    => ['required'],
                'user_id' => ['required', 'exists:users,id', 'unique:cars,user_id,' . $id],
            ],
            [
                'name.required'          => 'Car name is required.',
                'name.min'               => 'Car name must be at least 2 characters.',
                'number_plate.unique'    => 'This number plate is already registered.',
                'type.required'          => 'Please select a Car type.',
                'type.in'                => 'Invalid Car type selected.',
                'capacity.required'      => 'Seating capacity is required.',
                'capacity.min'           => 'Capacity must be at least 1.',
                'capacity.max'           => 'Capacity cannot exceed 500.',
                'user_id.required'       => 'Please select a driver.',
                'user_id.exists'         => 'Selected driver does not exist.',
                'user_id.unique'         => 'This driver already assigned with a car'
            ]
        );

        $car->update($validated);

        return redirect()
            ->route('admin.car.index')
            ->with('success', "Vehicle \"{$car->name}\" has been updated.");
    }

    /**
     * Remove the specified vehicle from the database.
     */
    public function delete($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()
            ->route('admin.car.index')
            ->with('success', "Car has been deleted.");
    }

    /**
     * Toggle the active/inactive status of a vehicle.
     */
    public function toggle($id, $status)
    {
        $car = Car::findOrFail($id);
        $status = $status == 1 ? 0 : 1;
        $car->update(['status' => $status]);

        $status = $car->status ? 'activated' : 'deactivated';

        return back()->with('success', "Car " . $status . "!.");
    }
}
