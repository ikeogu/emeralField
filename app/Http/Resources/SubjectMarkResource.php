<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Subject as SubjectResource;
use App\Http\Resources\Student as StudentResource;
use App\Student;
use App\Subject;

class SubjectMarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
     {
    //     $student =StudentResource::collection($this->whenLoaded('student'));
    //     $sub = SubjectResource::collection($this->whenLoaded('subject'));
        return [
            
        'student' => Student::where('id', $this->student_id)->first()->surname.' '. Student::where('id', $this->student_id)->first()->name,
         'subject' => Subject::where('id', $this->subject_id)->first()->name,
            // 'student_name' => $this->student->surname.$this->student->surname.,
            // 'subject_name' => $sub,
            // 'subject'=>$this->subject->name,
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            'TCA' => $this->TCA,
            
            'HW'=>$this->HW,
            'CW'=>$this->CW,
            'FT' =>$this->FT,
            'HA' =>$this->HA,
            'Summative_test' =>$this->Summative_test,
            'Exam' =>$this->Exam,
            'MSC' =>$this->MSC,
            'GT'=>$this->GT,
            'CAT1' =>$this->CAT1,
            'CAT2'=>$this->CAT2,
        ];
    }
}
