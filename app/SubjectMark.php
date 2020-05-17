<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectMark extends Model
{
    //
    protected $fillable = [
        'student_id',
        'subject_id',
        'HW',
        'CW',
        'FT',
        'HA',
        'Summative_test',
        'Exam',
        'MSC',
        'GT',
        'CAT1',
        'CAT2',
        

    ];
    public function subject(){
        return $this->belongsToMany(Subject::class);
    }
    public function student(){
        return $this->belongsToMany(Student::class);
    }
}
