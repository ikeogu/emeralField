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
    
    
    
    public function studentMark(){
        return $this->belongsToMany(SubjectMark::class);
    }

    public function user(){
        return $this->belongsToMany(User::class);
    }
}
