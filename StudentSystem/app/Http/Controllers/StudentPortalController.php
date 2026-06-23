<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentPortalController extends Controller
{
    /**
     * Show the student's personal profile (Name, Email, Change Password).
     */
    public function profile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    /**
     * Update the student's personal profile (Name and Email).
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        // If a student record is linked, sync name and email there too
        if ($user->student) {
            $user->student->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the student's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password you entered is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password changed successfully!');
    }

    /**
     * Show the student's academic/info section (Semester, Batch, Course, etc.).
     */
    public function info()
    {
        $user = Auth::user();
        $student = $user->student;

        return view('student.info', compact('student'));
    }

    /**
     * Show the student's fee records.
     */
    public function fees()
    {
        $user = Auth::user();
        $student = $user->student;
        $fees = $student ? $student->fees()->orderBy('id', 'desc')->get() : collect();

        return view('student.fees', compact('fees', 'student'));
    }
}
