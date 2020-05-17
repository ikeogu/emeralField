<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        return [
            
            'student_id' => $this->student_id,
            'subject_id' => $this->subject_id,
            // 'subject'=>$this->subject->name,
            
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
