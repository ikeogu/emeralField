<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $guarded = [];
    protected $fillable = [
       'name',
       'email',
       'surname',
        'roll_no',
        'dob',
        'gender',
       'p_email',
       'identification_mark',
       'contact',
       'address',
       's_class'
    ];
    public function getGenderAttribute($attribute)
    {
        return [
            1 => 'Male',
            2 => 'Female',
            3 => 'Other',
        ][$attribute];
    }

    /**
     * subjects that belong to the student.
     */
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function s5Class(){
        return $this->belongsToMany(S5Class::class);
    }

    public function term()
    {
        return $this->belongsToMany(Term::class)->withTimestamps();
    }
    
    
    
    public function subjectMark(){
        return $this->belongsToMany(SubjectMark::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public static function grade($val,$grades){
        $remarks = '';
        $per = (int) ($val);
            foreach($grades as $grade) {
                $arr = explode('-', $grade->percentage);
                if ($per >= $arr[0] && $per <= $arr[1]) {
                 return $remarks = $grade->grade;
                }
            }
        
    }
    public static function average($total,$object){
        return number_format(($total/$object),1);
    }

    public static function averPer($avg,$scores){
        return number_format((($avg/$scores) *100),1);
    }

    public static function min_score($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->Summative_test);
        }
        
        return min($score_list);
    }
    
    public static function max_score($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->Summative_test);
        }
        
        return max($score_list);
    }
    public static function subject_total($subject_id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $sum =0;
        foreach ($scores as $key => $value) {
            # code...
            $sum +=$value->Summative_test;
        }
        return $sum;
    }

    public static function average_per($sum,$n){
        return ($sum / $n) * 100;
    }
    // Calculations For Examination
    public static function subject_total_E($subject_id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $sum =0;
        foreach ($scores as $key => $value) {
            # code...
            $sum +=$value->Exam;
        }
        return $sum;
    }
    public static function max_score_E($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->Exam);
        }
        
        return max($score_list);
    }
    public static function min_score_E($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->Exam);
        }
        
        return min($score_list);
    }

    public static function subject_total_TCA($subject_id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $sum =0;
        foreach ($scores as $key => $value) {
            # code...
            $sum +=$value->TCA;
        }
        return $sum;
    }
    public static function max_score_TCA($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->TCA);
        }
        
        return max($score_list);
    }
    public static function min_score_TCA($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->TCA);
        }
        
        return min($score_list);
    }

    public static function subject_total_GT($subject_id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$subject_id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $sum =0;
        foreach ($scores as $key => $value) {
            # code...
            $sum +=$value->GT;
        }
        return $sum;
    }
    public static function max_score_GT($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->GT);
        }
        
        return max($score_list);
    }
    public static function min_score_GT($id,$class_id,$term_id){
        $scores = SubjectMark::where('subject_id',$id)->where('term_id',$term_id)->where('s5_class_id',$class_id)->get();
        $score_list = [];
        foreach ($scores as  $value) {
            # code...
            array_push($score_list,$value->GT);
        }
        
        return min($score_list);
    }
}
