<?php
   
   namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Term;
use App\S5Class;
use App\TermClasses;
use App\Student;
use App\SubjectMark;
use App\Subject;
use App\Teacher;
use App\StudentTermClass;
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
        $term = $request->isMethod('put') ? Term::findOrFail($request->term_id) : new Term;

        $term->id = $request->term_id;
        $term->name = $request->name;
        $term->description = $request->description;
        $term->session = $request->session;
        $term->status= 1;

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
        //   $class_1 = TermClasses::where('term_id','=',$term);

          foreach ($term->classes as $class) {
            //   $cls = S5Class::where('id','=',$t->class_id)->get();
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

  public function students_in_term($id){
        $term = Term::find($id);
        
        return view('class/studentClass',['terms'=>json_encode($term->student),'t'=>$term]);
  }
  public function term_class_t($class_id, $term,$subject_id){
   //visit here later if there is any future modification to make 
      $term = Term::find($term);
      $classes = S5Class::find($class_id);
      $subject = Subject::find($subject_id);
      
     
     $students = SubjectMark::with('student','subject')->where('subject_id', $subject->id)->where('term_id', $term->id)->get();
     
     return  SubjectMarkResource::collection($students);
       
      // return view('teacher/student_in_class',['students'=>json_encode($students),'t'=>$term,'classes'=>$classes]); 
     
  
  }

  public function add_student_term(Student $student, Term $term){
     return $term->student()->attach($student->id);
    
  }

  public function class_student($classid,$term){
   
    $term_ = Term::find($term);
    $class_ = S5Class::find($classid);
    $students = StudentTermClass::where('term_id',$term)->where('s5_class_id',$classid)->get();
    $ids = [];
    
    foreach($students as $stu){
      array_push($ids, $stu->student_id);
    }
    $class_std = Student::whereIn('id',$ids)->get();
    
    return view('class.classStudent',['students'=>json_encode($class_std),'t'=>$term_,'class_'=>$class_]);
  }
  
}
