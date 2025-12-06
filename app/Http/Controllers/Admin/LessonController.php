<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::when(request()->q,function($lessons){
            $lessons = $lessons->where('title','like','%'. request()->q. '%');

        })->latest()->paginate(5);

        $lessons->appends(['q' => request()->q]);
        return inertia('Admin/Lessons/Index',[
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Lessons/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'title' => 'required|string|unique:lessons',
       ]);

       Lesson::create([
        'title' => $request->title,
       ]);

       return redirect()->route('admin.lessons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
      $lesson = Lesson::findOrFail($id);

      return inertia('Admin/Lessons/Edit',[
        'lesson' => $lesson,
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required|string|unique:lessons,title,' .$lesson->id,
        ]);

        $lesson->update([
            'title' => $request->title,
        ]);

        return redirect()->route('admin.lessons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return redirect()->route('admin.lessons.index');
    }
}
