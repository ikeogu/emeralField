<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSubject extends Model
{
    protected $fillable =[
        'name',
        'avg',
        'student_id',
        's5_class_id',
        'term_id',
        'subject_id'
    ];

    public function subject(){
        return $this->belongsToMany(Subject::class);
    }
}
