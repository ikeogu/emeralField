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
        Route::apiResource('comments','CommentController');
        Route::apiResource('behaviour', 'BehaviourChartController');
        Route::apiResource('attend', 'AttendanceController');
        // assign subject for students

    
    Route::middleware('auth:api', 'throttle:60,1')->group(function () {
        Route::get('classes_all','S5ClassController@all_class');
        Route::get('students/{student}/unassignedsubjects/class/{class}/term/{term}', 'StudentController@unassignedSubjects');
        Route::get('students/{student}/assignedsubjects/class/{class}/term/{term}', 'StudentController@assignedSubjects');
        Route::post('students/{student}/assignsubject/{subject}/class/{class}/term/{term}', 'StudentController@assignSubject');
        Route::delete('students/{student}/deletesubject/{subject}/class/{class}/term/{term}', 'StudentController@deleteSubject');
        // Assign subject and class to Teachers
        Route::get('teachers/{teacher}/unassignedsubjects/', 'TeacherController@unassignedSubjects');
        Route::get('teachers/{teacher}/assignedsubjects/', 'TeacherController@assignedSubjects');
        Route::post('teachers/{teacher}/assignsubject/{subject}', 'TeacherController@assignSubject');
        Route::delete('teachers/{teacher}/deletesubject/{subject}', 'TeacherController@deleteSubject');
    
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
        Route::get('studentSubject/{id}/term/{term}/class/{class}','SubjectController@studentsubjects');
        Route::get('my_subjects/{student}/class/{class}/term/{term}','StudentController@my_record');
        Route::get('my_subject/{id}/class/{class}/term/{term}','SubjectController@my_subjects');
        // term structuring
        Route::post('term_class','TermController@term_class');
        // assignclass to term
        Route::get('terms/{term}/unassignedterms', 'TermController@unassignedClasses');
        Route::get('terms/{term}/assignedterms', 'TermController@assignedClasses');
        Route::post('term/{term}/assignclass/{class}', 'TermController@assignClass');
        Route::delete('terms/{term}/deleteclass/{class}', 'TermController@deleteClass');
        Route::delete('remove_stud_in_class/student/{student}/class/{class}/term/{term}','TermController@remove_stud_in_class');
        Route::get('terms_classes/{term}', 'TermController@termClasses');
        // 
        Route::get('class_terms/{class}', 'S5ClassController@term_class');
        //
        Route::get('students_in_term/{term}/class/{class}', 'TermController@students_in_term');
        
        Route::get('students_in_term2/{term}/class/{class}', 'TermController@students_in_term2');
        Route::get('term_students/{term}', 'TermController@term_students');
        Route::post('add_student_class/{student}/term/{term}/class/{class}', 'TermController@add_student_term');
        Route::get('s5class_term/{term}', 'S5ClassController@terms_class');
        // subjectMArk Controller
         Route::get('subjectMarks/{student}','SubjectMarkController@show_Mark');
        //  update SubjectMark
        // search student
        Route::get('/search','StudentController@search');
        Route::get('allstudents','StudentController@index2'); 
        // select term and class
        Route::get('teacher/{term}/assignclass/{class}/subject/{subject}', 'TermController@term_class_t')->name('tct');
        Route::get('student_in_class', 'TermController@term_class_t');
    
        Route::get('class_student/{class}/term/{term}', 'TermController@class_student');
        // assign class teacher
        Route::get('assignclassteacher/{teacher}/class/{class}/term/{term}','TeacherController@assignClassTeacher');
        Route::get('teacher_c/{teacher}','TeacherController@t_class');
        Route::get('comment/class/{class}/term/{term}','CommentController@my_class_comment');
        Route::get('behave/class/{class}/term/{term}','BehaviourChartController@my_class_behave');
        Route::get('attendance/class/{class}/term/{term}','AttendanceController@my_class_attend');
    });
});
