<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use Illuminate\Support\Facades\Hash;
use App\Student;
use App\Subject;
use App\StudentsClass;
use App\StudentTermClass;
use App\User;
use App\Term;
use App\S5Class;
use DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StudentCollection(Student::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
      $student = $request->isMethod('put') ? Student::findOrFail($request->student_id) : new Student;
      
      $student->name = $request->name;
      $student->surname = $request->surname;
      $student->roll_no = Student::max('id') + 1;
      $student->email = strtolower($student->name[0].$student->surname).$student->roll_no.'@efa.sch.ng';
      $student->dob = $request->dob;
      $student->p_email = $request->p_email;
      $student->gender = $request->gender;
      $student->contact = $request->contact;
      $student->address = $request->address;
      $student->s_class = $request->s_class; 
       $class = s5Class::find($request->s_class);
       $class->student()->attach($student);
       $student->level = $class->level;
      $student->identification_mark = $request->identification_mark;
      if($student->save()){

        $user = new User();
        $user->name = $student->name. $student->surname;
        $user->email = $student->email;
        $user->password = Hash::make(strtolower($student->name));
        $user->isAdmin = 4;
        $user->save();
        // StudentClass 
        $class = S5Class::find($student->s_class);
        $sess = Term::find($request->term_id);
        
        $class->session = null;
        $class->student()->attach($student->id);

        $stc = new StudentTermClass();
        $stc->student_id = $student->id;
        $stc->term_id = $request->term_id;
        $stc->s5_class_id = $class->id;
        
        $stc->save();

        return new StudentResource($student);
      }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(StudentRequest $request, Student $student)
    // {
    //     $data = $request->all();
    //     $student->update($data);

    //     return new StudentResource($student);
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return new StudentResource($student);
    }

        public function unassignedSubjects(Student $student)
        {
          $ids = [];
          foreach ($student->subjects as $subject) {
            array_push($ids, $subject->id);
          }

          $subjects = Subject::whereNotIn('id', $ids)->get();

          return $subjects;

        }

        public function assignedSubjects(Student $student)
        {
          return $student->subjects;
        }

      public function assignSubject(Student $student, Subject $subject)
      {
        $student->subjects()->attach($subject->id);
      }

      public function deleteSubject(Student $student, Subject $subject)
      {
        $student->subjects()->detach($subject->id);
      }

      public function new_class($s5class,$student){
        $class = S5Class::find($s5class);
        $stud = Student::findOrFail($student);
        $class->student()->attach($stud->id);
        return new StudentResource($class);
      }
}
