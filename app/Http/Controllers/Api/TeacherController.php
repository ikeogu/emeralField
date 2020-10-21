<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\TeacherResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\ClassTeacher;
use App\Http\Resources\S5ClassResource;
use App\Http\Resources\ClassTeacherResource;
use App\Teacher;
use App\User;
use App\Subject;
class TeacherController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new TeacherResourceCollection(Teacher::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Link the API to have class ID and Term ID
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
       $teacher =  $request->isMethod('put') ? Teacher::findOrFail($request->teacher_id) : new Teacher;

       $teacher->name = $request->name;
       $teacher->start_year = $request->start_year;
       $name = explode(' ',trim($teacher->name ));
       $teacher->email = strtolower($teacher->name[0].$name[1]).'@EFS.edu.ng';
       $teacher->status = $request->status;
       $teacher->level = $request->level;
        if($teacher->save()){

            $user = new User();
            $user->name = $teacher->name;
            $user->email = $teacher->email;
            $user->password = Hash::make(strtolower($name[0]));
            $user->isAdmin = 3;
            $user->teacher_id = $teacher->id;
            $user->save();

            return new TeacherResource($teacher);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $teacher = Teacher::findOrFail($id);
        return new TeacherResource($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $teacher = Teacher::find($id);
        $teacher->delete();
        return new TeacherResource($id);
    }

    
    public function unassignedSubjects(Teacher $teacher)
    {
      $ids = [];
      $t = Teacher::find($teacher->id);
      foreach ($t->subjects as $subject) {
        array_push($ids, $subject->id);
      }

      $subjects = Subject::whereNotIn('id', $ids)->get();

      return $subjects;

    }

    public function assignedSubjects(Teacher $teacher)
    {
      $ids = [];
      
      $t = Teacher::find($teacher->id);
      foreach ($t->subjects as $subject) {
        array_push($ids, $subject->id);
      }
      
        $subjects = Subject::whereIn('id', $ids)->get();
        
     return $subjects;
    }

  public function assignSubject(Teacher $teacher, Subject $subject)
  {
    
    $teacher->subjects()->attach($subject->id);         
  }

  public function deleteSubject(Teacher $teacher, Subject $subject)
  {
    $teacher->subjects()->detach($subject->id);
  }

  public function assignClassTeacher($teacherid,$classid,$termid){
  
    $classTeacher = new ClassTeacher();
    $classTeacher->teacher_id = $teacherid;
    $classTeacher->s5_class_id = $classid;
    $classTeacher->term_id = $termid;
    $classTeacher->save();
    return new ClassTeacherResource($classTeacher);

  }
  public function t_class($teacherid){
    $te = Teacher::find($teacherid);
    $ct = ClassTeacher::where('teacher_id',$te->id)->get();
    return  json_encode($ct);
  }
  
 
}
