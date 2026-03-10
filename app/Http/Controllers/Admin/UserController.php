<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|numeric|max_digits:11',
            'role' => 'required|in:admin,student,driver',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $path = $request->file('photo')->store('user', 'public');
            $imageURL = asset('storage/' . $path);
            $validatedData['photo'] = $imageURL;
        }

        $validatedData['password'] = Hash::make(time());
        User::create($validatedData);

        return redirect()->route('admin.user.index')->with('success', 'User added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|numeric|max_digits:11',
            'role' => 'required|in:admin,student,driver',
            'status' => 'required|in:active,inactive',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            // delete old photo
            if ($user->photo) {
                $oldPath = str_replace(asset('storage/') . '/', '', $user->photo);
                Storage::disk('public')->delete($oldPath);
            }

            $path = $request->file('photo')->store('user', 'public');
            $imageURL = asset('storage/' . $path);

            $validatedData['photo'] = $imageURL;
        }

        $user->update($validatedData);

        return redirect()->route('admin.user.index')
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'User Deleted!');
    }

    public function toggle($id, $status)
    {
        $user = User::findOrFail($id);
        $user->status = $status == 'active' ? 'inactive' : 'active';
        $user->save();

        return back()->with('success', 'User ' . Str::ucfirst($user->status) . 'd!');
    }
}
