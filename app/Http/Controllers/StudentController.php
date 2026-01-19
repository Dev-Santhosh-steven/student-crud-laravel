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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'phone' => 'required'
        ]);

        Student::create($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(['success' => true]);
    }

public function show(Student $student)
{
    return response()->json($student);
}

public function update(Request $request, Student $student)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:students,email,' . $student->id,
        'phone' => 'required',
    ]);

    $student->update($request->all());

    return response()->json(['success' => true]);
}


}

