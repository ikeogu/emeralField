<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Student;

class AttandanceResource extends JsonResource
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
            'id'=>$this->id,
            'student'=>Student::where('id',$this->student_id)->first()->surname.''.Student::where('id',$this->student_id)->first()->name,
            'dp'=>$this->dp,
            'da' =>$this->da,
            'tar'=>$this->tar,
        ];
    }
}
