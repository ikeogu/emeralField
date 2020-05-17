<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\TeacherResourceCollection;
use App\Teacher;
use App\User;

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
       $teacher =  $request->isMethod('put') ? Teacher::findOrFail($request->teacher_id) : new Teacher;

       $teacher->name = $request->name;
       $teacher->start_year = $request->start_year;
       $name = explode(' ',trim($teacher->name ));
       $teacher->email = strtolower($teacher->name[0].$name[1]).'@emeraldField.edu.ng';
       $teacher->status = $request->status;
       $teacher->level = $request->level;
        if($teacher->save()){

            $user = new User();
            $user->name = $teacher->name;
            $user->email = $teacher->email;
            $user->password = Hash::make(strtolower($name[0]));
            $user->isAdmin = 3;
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
}
