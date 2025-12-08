<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::when(request()->q,function($student){
            $students = $student->where('name','like','%'. request()->q .'%');

        })->with('classroom')->latest()->paginate(5);
        
        $students->appends(['q' => request()->q ]);
        return inertia('Admin/Students/Index',[
            'students' => $students,
        ]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classrooms = Classroom::all();

        return inertia('Admin/Students/Create',[
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'name' => 'required|string|max:255',
        'nisn' => 'required|unique:students',
        'gender' => 'required|string',
        'password' => 'required|confirmed',
        'classroom_id' => 'required'
       ]);

       Student::create([
        'name' => $request->name,
        'nisn' => $request->nisn,
        'gender' => $request->gender,
     'password' => bcrypt($request->password),

        'classroom_id'=> $request->classroom_id
       ]);

       return redirect()->route('admin.students.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classrooms  = Classroom::all();

        return inertia('Admin/Student/Edit',[
            'student' => $student,
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'required|unique:students,nisn,'.$student->id,
            'gender' => 'required|string',
            'classroom_id' => 'required',
            'password' => 'confirmed'
        ]);
            if($request->password == ""){
                // update tanpa password
                $student->update([
                    'name' => $request->name,
                    'nisn' => $request->nisn,
                    'gender' => $request->gender,
                    'classroom_id' => $request->classroom_id
                ]);
            }
                else {
                    // update data dengan password
                    $student->update([
                        'name' => $request->name,
                        'nisn' => $request->nisn,
                        'gender' => $request->gender,
                       'password' => bcrypt($request->password),

                        'classroom_id' => $request->classroom_id
                    ]);
                }
            
                return redirect()->route('admin.students.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index');
    }

       public function import()
    {
        return inertia('Admin/Students/Import');
    }

    public function storeImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // import data
        Excel::import(new StudentsImport(), $request->file('file'));
        return redirect()->route('admin.students.index');
    }
}
