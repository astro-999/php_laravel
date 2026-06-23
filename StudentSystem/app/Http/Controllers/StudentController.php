<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    //show all students
    public function index(Request $request)
    {
        $query = Student::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('course', 'like', "%{$search}%")
                  ->orWhere('semester', 'like', "%{$search}%")
                  ->orWhere('batch', 'like', "%{$search}%")
                  ->orWhere('year', 'like', "%{$search}%");
            });
        }

        $students = $query->orderby("id")->paginate(10)->withQueryString();
        return view('students.index', compact('students'));
    }

    //create form
    public function create()
    {
        return view('students.create');
    }

    //save new student + auto-create user account
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'required',
            'address' => 'required',
            'semester' => 'required',
            'batch' => 'required',
            'course' => 'required',
            'year' => 'required',
        ]);

        // Create a user account for the student
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('student123'),
            'role' => 'student',
        ]);

        // Create the student linked to the user
        $data = $request->all();
        $data['user_id'] = $user->id;
        Student::create($data);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully. Login: ' . $request->email . ' / student123');
    }

    //show single student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required',
            'address' => 'required',
            'semester' => 'required',
            'batch' => 'required',
            'course' => 'required',
            'year' => 'required',
        ]);

        // Sync user account if exists
        if ($student->user) {
            $student->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        $student->update($request->all());

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        // Delete linked user account
        if ($student->user) {
            $student->user->delete();
        }
        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully');
    }
}
