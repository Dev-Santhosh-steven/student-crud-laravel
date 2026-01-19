<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'required|numeric',
        ]);

        $student = Student::create($request->all());

        return redirect()->route('students.index', $student->id)->with('success', 'Student added successfully');
    }

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
            'name'  => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'phone' => 'required|numeric',
        ]);

        $student->update($request->all());

        return redirect()->route('students.index', $student->id)->with('success', 'Student updated successfully');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['success' => true]);
    }
}
