<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //show all students
    public function index()
    {
        $students = Student :: orderby("id")->paginate(5);
        return view('students.index',compact('students'));
    }

    //create form
    public function create()
    {
        return view('students.create');
    }

    //save new students
    public function store(Request $request)
    {
        $request->validate([
        'name'=>'required',
        'email' =>'required|email|unique:students',
        'phone' => 'required',
        'address'=> 'required',

        ]);
        Student::create($request->all());
        return redirect()-> route('students.index')
                        ->with('success','Student created sucessfully ');
    }

    //show single student
    public function show(Student $student)
    {
        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view('students.edit',compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
        'name'=>'required',
        'email'=> 'required|email|unique:students,email,'.$student->id,
        'phone' => 'required',
        'address'=> 'required',
        ]);
    $student->update($request->all());

    return redirect()->route('students.index')
                    ->with('success','Student updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
                        ->with('success','Student deleted sucessfully');
    }
}
