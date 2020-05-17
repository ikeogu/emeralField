<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class S5Class extends Model
{
    //
    protected $fillable = ['name','no_of_students','description','status'];


    public function student(){
        return $this->belongsToMany(Student::class);
    }

    public function term()
    {
        return $this->belongsToMany(Term::class);
    }
    public function studtermclass()
    {
        return $this->hasMany('App\StudentTermClass');
    }
}
