<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $guarded = [];
    protected $fillable = ['name','description','home_work','class_work','friday_test','holiday_assignment','level','summative_test','cat_1','cat_2','exam'];

    /**
     * students that belong to the subject.
     */
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function studentMark(){
        return $this->belongsToMany(SubjectMark::class);
    }
}
