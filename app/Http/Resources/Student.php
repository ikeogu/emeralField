<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Subject as SubjectResource;

class Student extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'p_email' => $this->p_email,
            'surname' => $this->surname,
            'roll_no' => $this->roll_no,
            'gender' => $this->gender,
            'contact' => $this->contact,
            'dob' => $this->dob,
            'address' => $this->address,
            'identification_mark'=> $this->identification_mark,
            'subjects' => SubjectResource::collection($this->whenLoaded('subjects')),
        ];
    }
}
