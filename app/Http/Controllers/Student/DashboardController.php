<?php

namespace App\Http\Controllers\Student;

use App\Models\Grade;
use App\Models\ExamGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $exam_groups = ExamGroup::with('exam.lesson','exam_session','student.classroom')
        ->where('student_id',auth()->guard('student')->user()->id)
        ->get();

        $data = [];
        foreach ($exam_groups as $exam_group)
        {
            $grade = Grade::where('exam_id',$exam_group->exam_id)
            ->where('exam_session_id',$exam_group->exam_session_id)
            ->where('student_id', auth()->guard('student')->user()->id)
            ->first();

            if($grade == null) {
                 $grade = new Grade();
                $grade->exam_id         = $exam_group->exam_id;
                $grade->exam_session_id = $exam_group->exam_session_id;
                $grade->student_id      = auth()->guard('student')->user()->id;
                $grade->duration        = $exam_group->exam->duration * 60000;
                $grade->total_correct   = 0;
                $grade->grade           = 0;
                $grade->save();
            }

             $data[] = [
                'exam_group' => $exam_group,
                'grade'      => $grade
            ];

        }
         return inertia('Student/Dashboard/Index', [
            'exam_groups' => $data,
        ]);
    }
}
