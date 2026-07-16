<?php

namespace App\Modules\RomualdezStalker\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\RomualdezStalker\Models\Student;

class RoomController extends Controller
{
    // Display dashboard list
    public function index()
    {
        $students = Student::all();
        return view('RomualdezStalker::index', compact('students'));
    }

    // Process saving a new student record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id',
            'name'       => 'required|string|max:255',
            'course'     => 'required|string',
            'year'       => 'required|integer',
            'email'      => 'required|email|unique:students,email',
        ]);

        Student::create($validated);
        return redirect()->back();
    }

    // Process updating an existing student entry
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        
        $validated = $request->validate([
            'student_id' => 'required|unique:students,student_id,' . $student->id,
            'name'       => 'required|string|max:255',
            'course'     => 'required|string',
            'year'       => 'required|integer',
            'email'      => 'required|email|unique:students,email,' . $student->id,
        ]);

        $student->update($validated);
        return redirect()->back();
    }

    // Process deleting a student record
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back();
    }
}
