<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
class StudentController extends Controller
{
    //
    public function addStudent(Request $request){

        $student = new Student;
        $student->name= $request->name;
        $student->email= $request->email;
        $student->save();

        return response()->json(['res'=>'Student Created Successfully.']);
    }

    public function index()
{
    $students = Student::all();
    return response()->json($students);
}

public function edit($id)
{
    $student = Student::findOrFail($id);
    return view('edit', compact('student'));
}


public function update(Request $request, $id)
{
    $student = Student::findOrFail($id);
    $student->name = $request->name;
    $student->email = $request->email;
    $student->save();

    return response()->json(['message' => 'Student updated successfully']);
}
public function destroy($id)
{
    // Logic to delete the student with the given ID
    Student::where('id',$id)->delete();
    return response()->json(['result' => 'Student deleted successfully']);
}

}
