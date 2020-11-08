<?php

namespace App\Http\Controllers;

use App\ClassTeacher;
use App\Http\Resources\ClassTeacherResource;
use App\S5Class;
use Illuminate\Http\Request;
use App\Teacher;
use App\Term;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    //

    public function dashboard(){
         
        if(Auth::check()){
            $stud = Teacher::find(Auth::user()->teacher_id);
            $subjects = $stud->subjects;
            return view('teacher/dashboard',['teacher'=>$stud,'subjects'=>$subjects]);
        }
        return redirect(route('login'));
    }

    public function my_subject_student(){

        if(Auth::check()){
            if( $stud = Teacher::find(Auth::user()->teacher_id)){
                $subjects = $stud->subjects;
                return view('teacher/dashboard',['teacher'=>$stud,'subjects'=>$subjects]);
            }
        }
        return redirect(route('login'));
    }

    public function sub_class(){
        return view('teacher/student_in_class');
    }
    // fix you later
    public function classt($id){
        $te = Teacher::find($id);
        $ct = ClassTeacher::where('teacher_id',$te->id)->get();
        $classt = new ClassTeacherResource($ct);
        return view('teacher.classteacher',[ 'classt'=>$classt->toArray()]);
    }
}
