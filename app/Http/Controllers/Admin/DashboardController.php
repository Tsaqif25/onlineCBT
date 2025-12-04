<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamSession;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $student = Student::count();
        $exams = Exam::count();
        $exam_sessions = ExamSession::count();
        $classrooms = Classroom::count();


        return inertia('Admin/Dashboard/Index',[
            'students' => $student,
            'exams' => $exams,
            'exam_sessions' => $exam_sessions,
            'classrooms'=> $classrooms,
        ]);
    }
}
