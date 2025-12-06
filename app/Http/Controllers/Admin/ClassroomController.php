<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::when(request()->q,function($classrooms){
            $classrooms = $classrooms->where('title','like','%' . request()->q . '%');

        })->latest()->paginate(5);
        $classrooms->appends(['q' => request()->q]);

        return inertia('Admin/Classrooms/Index',[
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Classrooms/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'title' => 'required|string|unique:classrooms'
       ]);

       Classroom::create([
        'title' => $request->title,
       ]);

       return redirect()->route('admin.classrooms.index');
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
        $classroom = Classroom::findOrFail($id);

        return inertia('Admin/Classrooms/Edit',[
            'classroom' => $classroom,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'title' => 'required|string|unique:classrooms,title,'.$classroom->id,
        ]);
        $classroom->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.classrooms.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $classroom = Classroom::findOrFail($id);
        $classroom->delete();

        return redirect()->route('admin.classrooms.index');
    }
}
