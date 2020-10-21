<?php
   
   namespace App\Http\Controllers\Api;

use App\Attendance;
use App\BehaviourChart;
use App\ClassTeacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\S5ClassRequest;
use App\Term;
use App\S5Class;
use App\TermClasses;
use App\Student;
use App\SubjectMark;
use App\Subject;
use App\Comment;
use App\StudentTermClass;
use App\StudentTerm;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Resources\TermResource;
use App\Http\Resources\TermClassesResource;
use App\Http\Resources\TermResourceCollection;
use App\Http\Resources\S5ClassResource;
use App\Http\Resources\S5ClassResourceCollection;
use App\Http\Resources\SubjectMarkResource;
use App\Http\Resources\SubjectMarkCollection;

use App\Http\Resources\Subject as SubjectResource;

use App\Http\Resources\Student as StudentResource;
use Illuminate\Database\Eloquent\Collection;

class TermController extends Controller
{
  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $term = Term::all();
        return new TermResourceCollection(Term::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $this->validate(request(),[
            'name'=> 'required|string',
        ]);
        $term = $request->isMethod('put') ? Term::findOrFail($request->term_id) : new Term ();

        
        $term->name = $request->name;
        $term->description = $request->description;
        $term->session = $request->session;
        $term->status= 1;
        $term->fee_h = $request->fee_h;
        $term->fee_y = $request->fee_y;
        $term->fee_e = $request->fee_e;
        $term->resumption_date = $request->resumption_date;

        if($term->save()){
            return new TermResource($term);
        }

    }

  
    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show($term)
    {
        //
        $t = Term::find($term);
        return new TermResource($t);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit($term)
    {
        //
        $t = Term::find($term);
        return new TermResource($t);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
     $terms= Term::whereId($request->term_id)->update($request->except(['_method','_token','term_id']));
      // return new TermResource($terms);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy($term)
    {
        //
        $t = Term::find($term);
        $t->delete();
        return new TermResource($t);
    }

    public function unassignedClasses(Term $term)
    {
          $ids = [];
          foreach ($term->classes as $class) {
            array_push($ids, $class->id);
          }
         $classes = S5Class::whereNotIn('id', $ids)->get();
          return $classes;

    }

    public function assignedClasses($term){
        $term_1 = Term::find($term);
        return $term_1->classes;
    }
    public function assignClass($term, $s5class)
  {
    $term_1 = Term::find($term);
    $s5class_1 = S5Class::find($s5class);
    
    $term_1->classes()->attach($s5class_1->id);
    $term_1->save();

  }
  public function deleteClass($term,$s5class)
  {
    $term_1 = Term::find($term);
    $s5class_1 = S5Class::find($s5class);
  
    $term_1->classes()->detach($s5class_1->id);
  }

  public function termClasses($id){

    $term = Term::find($id);
    $classes = $term->classes;
    return view('class/termClasses',['classes'=>$classes,'term'=>$term]);
    // return  new S5ClassResourceCollection($classes);
  }
  public function term_class($id, $term){

    $term = Term::find($id);
    $classes = S5Class::find($term);
    return  new S5ClassResourceCollection($classes->term);
  }
// this function fetches each student from the appropiate class and term
  public function students_in_term($id,$class_id){

        $term = Term::find($id);
        $class_T = S5Class::find($class_id);
        $student_id = StudentTerm::where('s5_class_id', $class_id)->where('term_id',$id)->get();
        $ids = array();
        foreach($student_id as $id){
          array_push($ids,$id->student_id);
        } 
        $students = Student::whereIn('id',$ids)->get();
        return view('class/studentClass',['terms'=>$students,'t'=>$term,'class_T'=>$class_T]);
  }
  public function students_in_term2($id,$class_id){

    $term = Term::find($id);
    $class_T = S5Class::find($class_id);
    $student_id = StudentTerm::where('s5_class_id', $class_id)->where('term_id',$id)->get();
    $ids = array();
    foreach($student_id as $id){
      array_push($ids,$id->student_id);
    } 
    $students = Student::whereIn('id',$ids)->get();
    return view('class/studentClass2',['terms'=>$students,'t'=>$term,'class_T'=>$class_T]);
}
  public function term_class_t($class_id, $term,$subject_id){
   //visit here later if there is any future modification to make 
      $term = Term::find($term);
      $classes = S5Class::find($class_id);
      $subject = Subject::find($subject_id);
      $students = SubjectMark::with('student','subject')->
      where('subject_id', $subject->id)->where('term_id', $term->id)->
      where('s5_class_id', $classes->id)->get();
      return  SubjectMarkResource::collection($students);  
      // return view('teacher/student_in_class',['students'=>json_encode($students),'t'=>$term,'classes'=>$classes]); 
     
  
  }
 //Add student to their appropiate class and Term
  public function add_student_term(Student $student, Term $term, $s5class){
    $class_ = S5Class::find($s5class);
    $studentTerm = new StudentTerm();
    $comment = new Comment();
    $behaviour = new BehaviourChart();
    $attend = new Attendance();
    $class_teacher = ClassTeacher::where('term_id',$term->id)->where('s5_class_id',$class_->id)->first();

    if($class_teacher != null) {
      //code...
      $studentTerm->term_id = $term->id;
      $studentTerm->s5_class_id = $class_->id;
      $studentTerm->student_id = $student->id;
      $studentTerm->subject_id = 17;
      // add teacher and student to Term and ...
      
      $comment->term_id = $studentTerm->term_id;
      $comment->s5_class_id = $studentTerm->s5_class_id;
      $comment->student_id = $studentTerm->student_id;
      $comment->teacher_id = $class_teacher->teacher_id;
      $comment->comment = '';
      $comment->hcomment = '';
      $behaviour->term_id = $studentTerm->term_id;
      $behaviour->s5_class_id = $studentTerm->s5_class_id;
      $behaviour->student_id = $studentTerm->student_id;
      // attendance
      $attend->term_id = $studentTerm->term_id;
      $attend->s5_class_id = $studentTerm->s5_class_id;
      $attend->student_id = $studentTerm->student_id;

      
      if($studentTerm->save()){
        $attend->save();
        $behaviour->save();
        $comment->save();
      }
      return $studentTerm;
    }else {
       return back()->with('success', 'Teacher has Not been assigned to a class');
    }
   
    //  check what happens after adding a child
  }
  public function remove_stud_in_class($studid, $classid, $termid){
    $student = Student::find($studid);
    $class_ = S5Class::find($classid);
    $term = Term::find($termid);
    $studTerm = StudentTerm::where('term_id',$term->id)->where('s5_class_id',$class_->id)->first();
    $comment = Comment::where('student_id',$student->id)->where('term_id',$term->id)->where('s5_class_id',$class_->id)->first();
    $att = Attendance::where('student_id',$student->id)->where('term_id',$term->id)->where('s5_class_id',$class_->id)->first();
    $behave = BehaviourChart::where('student_id',$student->id)->where('term_id',$term->id)->where('s5_class_id',$class_->id)->first();
    $comment->delete();
    $behave->delete();
    $att->delete();
    $studTerm->delete();
    return $studTerm;
    
  }
  public function class_student($classid,$term){
   
    $term_ = Term::find($term);
    $class_ = S5Class::find($classid);
    $students = StudentTerm::where('term_id',$term)->where('s5_class_id',$classid)->get();
    $ids = [];
    
    foreach($students as $stu){
      array_push($ids, $stu->student_id);
    }
    $class_std = Student::whereIn('id',$ids)->get();
    
    return view('class.classStudent',['students'=>json_encode($class_std),'t'=>$term_,'class_'=>$class_]);
  }
  
}
