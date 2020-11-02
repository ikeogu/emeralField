<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Average;
use App\BehaviourChart;
use App\ClassTeacher;
use App\Comment;
use Illuminate\Http\Request;
use App\Student;
use App\Subject;
use App\User;
use App\StudentTermClass;
use App\Term;
use App\S5Class;
use App\SubjectMark;
use App\GradeSetting;
use PDF;
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
    public function jhschool(){
        $h = Student::where('level','=','Junior High School')->get();
        return view('students/jhschool',['h'=>$h]);
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
        $dets = $this->details($term_id,$class_1);
        foreach ($dets['subject'] as $value) {
            # code...
            $SMT_score = $value->summative_test;
        }
        return view('results.summative',['students'=>$dets['students'], 'subject'=>$dets['subject'],'SMT_score'=>$SMT_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
       
    }

    
    public function exam($term_id,$class_1){
        $dets = $this->details($term_id,$class_1);
        // $students[] = (array) $class_std;
        foreach ($dets['subject'] as $value) {
            # code...
            $EXAM_score = $value->exam;
        }       
        return view('results.exam',['students'=>$dets['students'], 'subject'=>$dets['subject'],'EXAM_score'=>$EXAM_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
    }
    public function grandTotal($term_id,$class_1){
        $dets = $this->details($term_id,$class_1);
        $GT_score =100;             
        return view('results.gt',['students'=>$dets['students'], 'subject'=>$dets['subject'],'GT_score'=>$GT_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
    }
    public function tca($term_id,$class_1){
        $dets = $this->details($term_id,$class_1);
        $TCA_score = 50;
        return view('results.tca',['students'=>$dets['students'], 'subject'=>$dets['subject'],'TCA_score'=>$TCA_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
    }
    public function cat1s($term_id,$class_1){
        $dets = $this->details($term_id,$class_1);
        $TCA_score = 20;
        return view('results.cat1_broadsheet',['students'=>$dets['students'], 'subject'=>$dets['subject'],'TCA_score'=>$TCA_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
    }
    public function cat2s($term_id,$class_1){
        $dets = $this->details($term_id,$class_1);
        $TCA_score = 20;
        return view('results.cat2_broadsheet',['students'=>$dets['students'], 'subject'=>$dets['subject'],'TCA_score'=>$TCA_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
    }
    public function msc($term_id,$class_1){
        $dets = $this->details($term_id,$class_1);
        $TCA_score = 10;
        return view('results.msc',['students'=>$dets['students'], 'subject'=>$dets['subject'],'TCA_score'=>$TCA_score,'grades'=>$dets['grades'],'term'=>$dets['term'],'class_'=>$dets['class_']]);
    }
    public function summative_sheet($student_id,$term_id,$class_id){
        $dets = $this->det($student_id,$term_id,$class_id);
        return view('results.summative_sheet',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades']]);

    }
    
    public function cat1($student_id,$term_id,$class_id){
        $dets = $this->det($student_id,$term_id,$class_id);
        return view('results.cat1',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades']]);

    }
    public function cat2($student_id,$term_id,$class_id){
        $dets = $this->det($student_id,$term_id,$class_id);
        return view('results.cat2',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades']]);

    }
    
    public function result_sheet($student_id,$term_id,$class_id){
        $dets = $this->det($student_id,$term_id,$class_id);
        
        if ($dets['class_']->status == 'Year School') {
            # code...
            return view('results.result',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades'],'classTeacher'=>$dets['te'],'comment'=>$dets['comment'],'behave'=>$dets['behave'],'attend'=>$dets['attend']]);

        }
        return view('results.h_result',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades'],'classTeacher'=>$dets['te'],'comment'=>$dets['comment'],'behave'=>$dets['behave'],'attend'=>$dets['attend']]);

    }
    private function det($student_id, $class_id, $term_id){
        $term = Term::find($term_id);
        $class_ = S5Class::find($class_id);
        $student = Student::find($student_id);
        $grades = GradeSetting::all();
        $scores = SubjectMark::where('student_id',$student_id)->where('term_id',$term_id)
        ->where('s5_class_id',$class_id)->get();
        
        $users = SubjectMark::select('student_id')->where('term_id',$term->id)
        ->where('s5_class_id',$class_->id)->distinct()->get();
        $te = ClassTeacher::with('teacher')->where('term_id',$term_id)->where('s5_class_id',$class_id)->first();
        $behave = BehaviourChart::where('term_id',$term->id)->where('s5_class_id',$class_->id)->where('student_id',$student->id)->first();
        $attend = Attendance::where('term_id',$term->id)->where('s5_class_id',$class_->id)->where('student_id',$student->id)->first();
        $comment = Comment::where('student_id',$student->id)->where('term_id',$term->id)
        ->where('s5_class_id',$class_->id)->first();
        return ['term'=>$term,'class_'=>$class_,'student'=>$student,'grades'=>$grades,'scores'=>$scores,'users'=>$users,'te'=>$te,'behave'=>$behave,'attend'=>$attend,'comment'=>$comment];
    }

    private function details($term_id,$class_1){
        $term = Term::find($term_id);
        $class_= S5Class::find($class_1);
        $grades = GradeSetting::all();
        $scores = SubjectMark::where('term_id',$term->id)->where('s5_class_id',$class_->id)->get();
        $ids = [];
        $sub_id = [];
        foreach($scores as $stu){
            array_push($ids, $stu->student_id);
            array_push($sub_id, $stu->subject_id);
        }
        $class_std = Student::whereIn('id',$ids)->with('subjectMark','subjects')->get();
        $subject = Subject::whereIn('id',$sub_id)->get();
        return ['students'=>$class_std, 'subject'=>$subject,'grades'=>$grades,'term'=>$term,'class_'=>$class_];
    }

    public function download_cat1($student_id,$term_id,$class_1){
        $data =$this->det($student_id,$term_id,$class_1);
        $pdf = PDF::loadView('pdf.cat1',['data'=>$this->det($student_id,$term_id,$class_1)]);        
        return $pdf->download($data['student']->surname.'_'.$data['student']->name.'_'.$data['term']->name.'_'.$data['class_']->name.'.pdf');
    }
    public function download_cat2($student_id,$term_id,$class_1){
        $data =$this->det($student_id,$term_id,$class_1);
        $pdf = PDF::loadView('pdf.cat2',['data'=>$this->det($student_id,$term_id,$class_1)]);        
        return $pdf->download($data['student']->surname.'_'.$data['student']->name.'_'.$data['term']->name.'_'.$data['class_']->name.'.pdf');
    }
    public function download_summative($student_id,$term_id,$class_1){
        $data =$this->det($student_id,$term_id,$class_1);
        $pdf = PDF::loadView('pdf.summative',['data'=>$this->det($student_id,$term_id,$class_1)]);        
        return $pdf->download($data['student']->surname.'_'.$data['student']->name.'_'.$data['term']->name.'_'.$data['class_']->name.'.pdf');
    }

    public function download_result($student_id,$term_id,$class_1){
        $dets = $this->det($student_id,$term_id,$class_1);
        
        if ($dets['class_']->status == 'Year School') {
            # code...
         $pdf = PDF::loadView('pdf.y_result',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades'],'classTeacher'=>$dets['te'],'comment'=>$dets['comment'],'behave'=>$dets['behave'],'attend'=>$dets['attend']]);
        return $pdf->download($dets['student']->surname.'_'.$dets['student']->name.'_'.$dets['term']->name.'_'.$dets['class_']->name.'.pdf');

        }
        if ($dets['class_']->status == 'Early Years') {
            # code...
         $pdf = PDF::loadView('pdf.e_years                                                                                                                                                                                                                                                                                                                                               ',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades'],'classTeacher'=>$dets['te'],'comment'=>$dets['comment'],'behave'=>$dets['behave'],'attend'=>$dets['attend']]);
        return $pdf->download($dets['student']->surname.'_'.$dets['student']->name.'_'.$dets['term']->name.'_'.$dets['class_']->name.'.pdf');

        }
        $pdf = PDF::loadView('pdf.h_result',['student'=>$dets['student'],'term'=>$dets['term'],'class_'=>$dets['class_'],'scores'=>$dets['scores'],'users'=>$dets['users'],
        'grades'=>$dets['grades'],'classTeacher'=>$dets['te'],'comment'=>$dets['comment'],'behave'=>$dets['behave'],'attend'=>$dets['attend']]);
        return $pdf->download($dets['student']->surname.'_'.$dets['student']->name.'_'.$dets['term']->name.'_'.$dets['class_']->name.'.pdf');

    }
}
