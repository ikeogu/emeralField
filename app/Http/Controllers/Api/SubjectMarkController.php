<?php
    namespace App\Http\Controllers\Api;

use App\Average;
use App\Http\Controllers\Controller;
use App\SubjectMark;
use App\Http\Resources\SubjectMarkResource;
use App\Http\Resources\SubjectMarkCollection;
use App\Http\Requests\SubjectMarkRequest;
use Illuminate\Http\Request;
use App\Subject;
use App\Student;
use App\Term;
use App\S5Class;

class SubjectMarkController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $mark = SubjectMark::all();
        return new SubjectMarkCollection($mark);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubjectMarkRequest $request)
    {
        //
      
        $subjectMark =  new SubjectMark();
        
        $student = Student::find($request->student_id);
        $subj = Subject::find($request->subject_id);

        if($student->level === 'High School' ){

            $subjectMark->subject_id = $request->subject_id;
            $subjectMark->student_id = $request->student_id;
            $subjectMark->HW = 0;
            $subjectMark->CW = 0;
            $subjectMark->FT = 0;
            $subjectMark->HA = 0;
            $subjectMark->summative_test = 0;
            $subjectMark->Exam = $request->Exam;
            $subjectMark->MSC = $request->MSC;
            $subjectMark->CAT1 = $request->CAT1;
            $subjectMark->CAT2 = $request->CAT2;

            $subjectMark->GT = $subjectMark->HW + $subjectMark->CW + $subjectMark->FT + $subjectMark->summative_test + $subjectMark->Exam + $subjectMark->MSC +$subjectMark->CAT1 + $subjectMark->CAT2;
            if($subjectMark->save()){
                //    return 
                    $subj->studentMark()->attach($subjectMark);
                    $student->studentMark()->attach($subjectMark);
                     return new SubjectMarkResource($subjectMark);
             }
           
        } elseif ($student->level === 'Year School') {
            # code...
            $subjectMark->subject_id = $request->subject_id;
            $subjectMark->student_id = $request->student_id;
            $subjectMark->HW = $request->HW;
            $subjectMark->CW = $request->CW;
            $subjectMark->FT = $request->FT;
            $subjectMark->HA = $request->HA;
            $subjectMark->Summative_test = $request->Summative_test;
            $subjectMark->Exam = $request->exam;
            $subjectMark->MSC = 0;
            $subjectMark->CAT1 = 0;
            $subjectMark->CAT2 = 0;
            $subjectMark->TCA = $subjectMark->HA + $subjectMark->HW + $subjectMark->CW + $subjectMark->FT + $subjectMark->Summative_test;
            $subjectMark->GT = $subjectMark->TCA+ $subjectMark->Exam ;
            if($subjectMark->save()){
                //    return 
                    $subj->studentMark()->attach($subjectMark);
                    $student->studentMark()->attach($subjectMark);
                    return new SubjectMarkResource($subjectMark);
               }

        } elseif($student->level === 'Early Years'){
            $subjectMark->subject_id = $request->subject_id;
            $subjectMark->student_id = $request->student_id;
            $subjectMark->HW = $request->HW;
            $subjectMark->CW = $request->CW;
            $subjectMark->FT = $request->FT;
            $subjectMark->HA = $request->HA;
            $subjectMark->Summative_test = $request->Summative_test;
            $subjectMark->Exam = $request->exam;
            $subjectMark->TCA =$subjectMark->HA +   $subjectMark->HW + $subjectMark->CW + $subjectMark->FT + $subjectMark->Summative_test;
            $subjectMark->GT = $subjectMark->TCA +  $subjectMark->Exam;
            if($subjectMark->save()){
                //    return 
                    $subj->studentMark()->attach($subjectMark);
                    $student->studentMark()->attach($subjectMark);
                    return new SubjectMarkResource($subjectMark);
               }
        }

        
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubjectMark  $subjectMark
     * @return \Illuminate\Http\Response
     */
    public function show($score_id)
    {
        //
        $subjectMark = SubjectMark::findOrFail($score_id);
        
        return new SubjectMarkResource($subjectMark);
    }
    
    public function show_Mark($student){
        $stud = Student::find($student);
        
        $marks = $stud->studentMark;
        
        return json_encode($marks);

        
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubjectMark  $subjectMark
     * @return \Illuminate\Http\Response
     */
    public function edit(SubjectMark $subjectMark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubjectMark  $subjectMark
     * @return \Illuminate\Http\Response
     */
    public function update(SubjectMarkRequest $request)
    {
      
        $subjectMarks=  SubjectMark::whereId($request->my_id)->update($request->except(['_method','_token','my_id']));
        $subjectMarks=  SubjectMark::find($request->my_id);
        $class__ = S5Class::find($subjectMarks->s5_class_id);
        if($class__->status === 'Year School'){
            $subjectMarks->summative_test = $request->summative_test;
            $subjectMarks->TCA =  $request->HA + $request->HW + $request->CW + $request->FT + $request->summative_test;
            $subjectMarks->GT = $subjectMarks->TCA +$request->Exam;
            $subjectMarks->save();
        }elseif($class__->status === 'High School'){
            
            $subjectMarks->TCA =  $request->MSC + $request->CAT1 + $request->CAT2;
            $subjectMarks->GT = $subjectMarks->TCA + $request->Exam;
            $subjectMarks->save();
        }
        
        $this->aver_($subjectMarks->term_id,$subjectMarks->student_id,$subjectMarks->s5_class_id);
        return new SubjectMarkResource($subjectMarks);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubjectMark  $subjectMark
     * @return \Illuminate\Http\Response
     */
    public function destroy($subjectMark)
    {
        //
        $s = SubjectMark::find($subjectMark);
        $s->delete();
        return new SubjectMarkResource($s);
    }

    private function aver_($term, $student, $class_){
        $term = Term::find($term);
        $class_= S5Class::find($class_);
        $stud = Student::with('subjectMark')->find($student);
        $total = 0;
            
           # code...
           foreach ($stud->subjectMark as $item) {
               # code...
               if($item->term_id === $term->id && $item->s5_class_id === $class_->id){                
                        $total += $item->GT;
                }
            }
            // find another way to update and create new average
            $avg = new Average();
            $avg->aver_ = $total /$stud->subjectMark->count();
            $avg->student_id = $stud->id;
            $avg->s5_class_id = $class_->id;
            $avg->term_id = $term->id;
            $avg->save();
        
    }

    
}
