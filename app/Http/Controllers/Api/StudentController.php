<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\S5ClassResource;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\s5ClassResourceCollection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Student;
use App\Subject;
use App\StudentsClass;
use App\SubjectMark;
use App\StudentTermClass;
use App\User;
use App\Term;
use App\S5Class;
use App\StudentSubject;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class StudentController extends Controller
{

  
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new StudentCollection(Student::paginate(100));
    }
    public function index2()
    {
      $students = Student::all();
      return response()->json($students);
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
      $student->oname = $request->oname;
      $student->surname = $request->surname;
      $student->roll_no = Student::max('id') + 1;
      $student->reg_no = $request->reg_no;
      $student->email = strtolower($student->name[0].str_ireplace (' ', '', $student->surname)).$student->roll_no.'@efa.sch.ng';
      $student->dob = $request->dob;
      $student->p_email = $request->p_email;
      $student->gender = $request->gender;
      $student->contact = $request->contact;
      $student->address = $request->address;
      $student->s_class = $request->s_class; 
       $class = s5Class::find($request->s_class);
      
       $student->level = $class->status;
      $student->identification_mark = $request->identification_mark;
      if($student->save()){
        $pass = Str::random(8);
        $class->student()->attach($student);
        $user = new User();
        $user->name = $student->name.'.'.$student->surname;
        $user->email = $student->email;
        $user->keep_track = $pass;
        $user->password = Hash::make($pass);
        $user->isAdmin = 4;
        $user->student_id =$student->id;
        $user->save();
        // StudentClass 
        $class = S5Class::find($student->s_class);
        $sess = Term::find($request->term_id);
        
        $class->session = null;
        $class->student()->attach($student->id);

        $stc = new StudentTermClass();
        $stc->student_id = $student->id;
        $stc->term_id = $sess->id;
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
    public function update(StudentRequest $request,  $id)
    {
      $student = Student::find($id);
      $student->name = $request->name;
      $student->oname = $request->oname;
      $student->surname = $request->surname;
      $student->reg_no = $request->reg_no;
      
      $student->dob = $request->dob;
      $student->p_email = $request->p_email;
      
      $student->contact = $request->contact;
      $student->address = $request->address;
        return new StudentResource($student);
    }

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

        public function unassignedSubjects(Student $student,$class_id,Term $term)
        {
          $ids = [];
          $marks = SubjectMark::where('student_id','=',$student->id)->where('term_id','=',$term->id)->where('s5_class_id',$class_id)
          ->get();
          $class = S5Class::find($class_id);
          foreach ($marks as $subject) {
            array_push($ids, $subject->subject_id);
          }
          $subjects = Subject::whereNotIn('id', $ids)->where('level','=',$class->status)->get();

          return $subjects;

        }

        public function assignedSubjects(Student $student,$class_id, Term $term)
        {
          $ids = [];
          
          $mark = SubjectMark::where('student_id','=',$student->id)->where('term_id','=',$term->id)->where('s5_class_id',$class_id)
           ->get();
          
          foreach ($mark as $subject) {
            array_push($ids, $subject->subject_id);
          }
          
            $subjects = Subject::whereIn('id', $ids)->get();
            
         return $subjects;
        }

      public function assignSubject(Student $student, Subject $subject,$s5class,Term $term)
      {
        $class_ = S5Class::find($s5class);
        $term->subject()->attach($subject->id,array('student_id' => $student->id,'s5_class_id'=>$class_->id));
        
        $student->subjects()->attach($subject->id,array('term_id' => $term->id,'s5_class_id'=>$class_->id));

              $mark = new SubjectMark();
              $mark->student_id = $student->id;
              $mark->subject_id = $subject->id;
              $mark->subname = $subject->name;
              $mark->term_id = $term->id;
              $mark->s5_class_id= $class_->id;
              $student->subjectMark()->save($mark);
              $subject->subjectMark()->save($mark);
              $class_->subjectMark()->save($mark);  
      }

      public function deleteSubject(Student $student, Subject $subject,$class_id, Term $term)
      {
       
        $sub = StudentSubject::where('student_id',$student->id)->where('term_id',$term->id)
        ->where('s5_class_id',$class_id)->where('subject_id',$subject->id)->first();
        if($sub !== null){
          $sub->delete();
          return response()->json(['message'=> 'Subject deleted',200]);
        
        }
        return response()->json(['message'=> 'Subject Not found',404]);
        
      }
      

      public function new_class($s5class,$student){
        $class = S5Class::find($s5class);
        $stud = Student::findOrFail($student);
        $class->student()->attach($stud->id);
        return new StudentResource($class);
      }
      public function myClasses($id){
        $imstudent = Student::find($id);
        $stc = StudentTermClass::where('student_id',$imstudent->id)->get();
        $arr = [];
        foreach($stc as $class){
          array_push($arr,$class->s5_class_id);
        }
        $myclass = S5Class::whereIn('id',$arr)->get();
        return  S5ClassResource::collection($myclass);
      }

      public function search(Request $request){
         $qry = $request->input('query');
        $users = DB::table('students')
        ->where('name','ILIKE','%'.$qry.'%')
        ->orWhere('oname','ILIKE','%'.$qry.'%')->
        orWhere('surname','ILIKE','%'.$qry.'%')->get();
        return response()->json($users);
      }

      public function my_record($id, $class_id, $term_id){
        $student = Student::find($id);
        $term = Term::find($term_id);
        $class = S5Class::find($class_id);
             
        return  view('students/term_sheet',['student'=>$student ,'class_T'=>$class, 'term'=>$term]);
      }

      
}
