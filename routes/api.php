<?php

use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', 'AuthController@postRegister');
Route::post('/auth/login', 'AuthController@postLogin');
Route::post('/auth/social', 'AuthController@postSocialLogin');

Route::group(['middleware' => ['auth.jwt']], function () {

    Route::get('/auth/logout', 'AuthController@logout');
});
Route::namespace('Api')->group(function () {
    Route::apiResource('students', 'StudentController');
    Route::apiResource('subjects', 'SubjectController');
    Route::apiResource('grades', 'GradeSettingController');
    Route::apiResource('schclasses', 'S5ClassController');
    Route::apiResource('teachers', 'TeacherController');
    Route::apiResource('terms', 'TermController');
    Route::apiResource('subjectMark','SubjectMarkController');

    Route::get('students/{student}/unassignedsubjects/{term}', 'StudentController@unassignedSubjects');
    Route::get('students/{student}/assignedsubjects/{term}', 'StudentController@assignedSubjects');
    Route::post('students/{student}/assignsubject/{subject}/term/{term}', 'StudentController@assignSubject');
    Route::delete('students/{student}/deletesubject/{subject}/term/{term}', 'StudentController@deleteSubject');
    Route::get('results/students', 'ResultController@students');
    Route::get('results/student/{student}', 'ResultController@result');
    Route::get('subjectlist', 'SubjectController@subjectList');
    Route::get('subjectstudents/subject/{subject}', 'SubjectController@subjectStudents');
    Route::post('subjectresult', 'MarksController@store');
    // route newly added
    // Route::resource('class', 'S5ClassController');
    Route::put('schclass/{key}','S5ClassController@store');
    
    Route::get('myclass/{id}','StudentController@myClasses');
    Route::get('studentsclass/{id}','S5ClassController@stud_classes');
    Route::get('studentSubject/{id}/term/{term}','SubjectController@studentsubjects');
    Route::get('my_subjects/{student}/class/{class}/term/{term}','StudentController@my_record');
    Route::get('my_subject/{id}/term/{term}','SubjectController@my_subjects');
    // term structuring
    Route::post('term_class','TermController@term_class');
    // assignclass to term
    Route::get('terms/{term}/unassignedterms', 'TermController@unassignedClasses');
    Route::get('terms/{term}/assignedterms', 'TermController@assignedClasses');
    Route::post('term/{term}/assignclass/{class}', 'TermController@assignClass');
    Route::delete('terms/{term}/deleteclass/{class}', 'TermController@deleteClass');
    Route::get('terms_classes/{term}', 'TermController@termClasses');
    // 
    Route::get('class_terms/{class}', 'S5ClassController@term_class');
    //
    Route::get('students_in_term/{term}', 'TermController@students_in_term');
    Route::get('term_students/{term}', 'TermController@term_students');
    Route::post('student/{student}/term/{term}', 'TermController@add_student_term');
    Route::get('s5class_term/{term}', 'S5ClassController@terms_class');
    // subjectMArk Controller
     Route::get('subjectMarks/{student}','SubjectMarkController@show_Mark');
    //  update SubjectMark
// search student
    Route::get('/search','StudentController@search');
    Route::get('allstudents','StudentController@index2'); 
});