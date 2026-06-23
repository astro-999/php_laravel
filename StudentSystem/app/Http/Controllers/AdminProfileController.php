<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    /**
     * Update the profile details.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}
