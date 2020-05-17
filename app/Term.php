<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    //
    protected $fillable = [
        'name',
        'session',
        'description',
        'status'
    ];

    public function classes(){
        return $this->belongsToMany(S5Class::class);
    }
    public function student(){
        return $this->belongsToMany(Student::class);
    }

    public function studtermclass()
    {
        return $this->hasMany('App\StudentTermClass');
    }
}
