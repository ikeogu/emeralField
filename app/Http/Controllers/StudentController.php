<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\User;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function dashboard(){
         
        if( $stud = Student::find(Auth::user()->student_id)){
            return view('students/biodata',['stud'=>$stud]);
        }
        return redirect(route('login'));
      }
}
