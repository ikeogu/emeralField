<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\User;
use App\StudentTermClass;
use App\Term;
use App\S5Class;
use App\SubjectMark;
use App\GradeSetting;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function dashboard(){
        
        if( $stud = Student::find(Auth::user()->student_id)){
            return view('students/biodata',['stud'=>$stud]);
        }
        return redirect(route('login'));
    }

    public function hschool(){
        $h = Student::where('level','=','High School')->get();
        return view('students/hschool',['h'=>$h]);
    }
    public function yschool(){
        $h = Student::where('level','=','Year School')->get();
        return view('students/yschool',['h'=>$h]);
    }
    public function eschool(){
        $h = Student::where('level','=','Early School')->get();
        return view('students/eschool',['h'=>$h]);
    }
    public function grade($val,$grades){
        $remarks = '';
        $per = (int) ($val);
            foreach($grades as $grade) {
                $arr = explode('-', $grade->percentage);
                if ($per >= $arr[0] && $per <= $arr[1]) {
                 return $remarks = $grade->grade;
                }
            }
        
    }
    public function average($total,$object){
        return number_format(($total/$object),1);
    }
    public function averPer($avg,$scores){
        return number_format((($avg/$scores) *100),1);
    }

    public function summative($term_id,$class_1){
        $term = Term::find($term_id);
        $class_= S5Class::find($class_1);
        $grades = GradeSetting::all();
        $scores = SubjectMark::where('term_id',$term->id)->where('s5_class_id',$class_->id)->get();
        $ids = [];
        $sub_id = [];
        $SMT_score = 0;
        
        foreach($scores as $stu){
        array_push($ids, $stu->student_id);
        array_push($sub_id, $stu->subject_id);
        }
        
        $class_std = Student::whereIn('id',$ids)->with('subjectMark','subjects')->get();
        $subject = Subject::whereIn('id',$sub_id)->get();
        foreach ($subject as $value) {
            # code...
            $SMT_score = $value->summative_test;
        }
        
        
            
        return view('results.summative',['students'=>$class_std, 'subject'=>$subject,  'grades'=>$grades,'SMT_score'=>$SMT_score,'term'=>$term,'class_'=>$class_]);
       
    }

    
    public function exam($term_id,$class_1){
        $term = Term::find($term_id);
        $class_= S5Class::find($class_1);
        $grades = GradeSetting::all();
        $scores = SubjectMark::where('term_id',$term->id)->where('s5_class_id',$class_->id)->get();
        $ids = [];
        $sub_id = [];
        $EXAM_score = 0;
        foreach($scores as $stu){
            array_push($ids, $stu->student_id);
            array_push($sub_id, $stu->subject_id);
        }
        
        $class_std = Student::whereIn('id',$ids)->with('subjectMark','subjects')->get();
        $subject = Subject::whereIn('id',$sub_id)->get();
        // $students[] = (array) $class_std;
        foreach ($subject as $value) {
            # code...
            $EXAM_score = $value->exam;
        }
                
        return view('results.exam',['students'=>$class_std, 'subject'=>$subject,'EXAM_score'=>$EXAM_score,'grades'=>$grades,'term'=>$term,'class_'=>$class_]);
    }
    public function grandTotal($term_id,$class_1){
        $term = Term::find($term_id);
        $class_= S5Class::find($class_1);
        $grades = GradeSetting::all();
        $scores = SubjectMark::where('term_id',$term->id)->where('s5_class_id',$class_->id)->get();
        $ids = [];
        $sub_id = [];
        $GT_score = 0;
        foreach($scores as $stu){
            array_push($ids, $stu->student_id);
            array_push($sub_id, $stu->subject_id);
        }
        
        $class_std = Student::whereIn('id',$ids)->with('subjectMark','subjects')->get();
        $subject = Subject::whereIn('id',$sub_id)->get();
        // $students[] = (array) $class_std;
        
            $GT_score = 100;
       
                
        return view('results.gt',['students'=>$class_std, 'subject'=>$subject,'GT_score'=>$GT_score,'grades'=>$grades,'term'=>$term,'class_'=>$class_]);
    }
    public function tca($term_id,$class_1){
        $term = Term::find($term_id);
        $class_= S5Class::find($class_1);
        $grades = GradeSetting::all();
        $scores = SubjectMark::where('term_id',$term->id)->where('s5_class_id',$class_->id)->get();
        $ids = [];
        $sub_id = [];
        $TCA_score = 0;
        foreach($scores as $stu){
            array_push($ids, $stu->student_id);
            array_push($sub_id, $stu->subject_id);
        }
        
        $class_std = Student::whereIn('id',$ids)->with('subjectMark','subjects')->get();
        $subject = Subject::whereIn('id',$sub_id)->get();
        // $students[] = (array) $class_std;
        
            # code...
            $TCA_score = 50;
       
                
        return view('results.tca',['students'=>$class_std, 'subject'=>$subject,'TCA_score'=>$TCA_score,'grades'=>$grades,'term'=>$term,'class_'=>$class_]);
    }
    

}
