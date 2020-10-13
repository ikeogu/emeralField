<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable=['name','email','status','start_year','level'];

   

        public function user(){
            return $this->belongsTo(User::class);
        }

        public function term(){
            return $this->belongsToMany(Term::class)->withPivot('subject_id')->withTimestamps();
        }
        
        public function subjects(){
            return $this->belongsToMany(Subject::class);
        }
        public function classTeacher(){
            return $this->hasOne(ClassTeacher::class);
        }
        public function comment(){
            return $this->hasMany(Comment::class);
        }
}
