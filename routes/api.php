<?php

use Illuminate\Http\Request;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        // Below mention routes are public, user can access those without any restriction.
        // Create New User
        Route::post('register', 'AuthController@register');
        // Login User
        Route::post('login', 'AuthController@login');
        
        // Refresh the JWT Token
        Route::get('refresh', 'AuthController@refresh');
        
        // Below mention routes are available only for the authenticated users.
        Route::middleware('auth:api')->group(function () {
            // Get user info
            Route::get('user', 'AuthController@user');
            // Logout user from application
            Route::post('logout', 'AuthController@logout');
        });
    });
});

Route::group(['middleware' => 'auth:api'], function(){
    // Users
    Route::get('users', 'UserController@index')->middleware('isAdmin');
    Route::get('users/{id}', 'UserController@show')->middleware('isAdminOrSelf');
});

Route::namespace('Api')->group(function () {
    Route::apiResource('students', 'StudentController');
    Route::apiResource('subjects', 'SubjectController');
    Route::apiResource('grades', 'GradeSettingController');
    Route::apiResource('schclasses', 'S5ClassController');
    Route::apiResource('teachers', 'TeacherController');
    Route::apiResource('terms', 'TermController');
    Route::apiResource('subjectMark','SubjectMarkController');

    Route::get('students/{student}/unassignedsubjects', 'StudentController@unassignedSubjects');
    Route::get('students/{student}/assignedsubjects', 'StudentController@assignedSubjects');
    Route::post('students/{student}/assignsubject/{subject}', 'StudentController@assignSubject');
    Route::delete('students/{student}/deletesubject/{subject}', 'StudentController@deleteSubject');
    Route::get('results/students', 'ResultController@students');
    Route::get('results/student/{student}', 'ResultController@result');
    Route::get('subjectlist', 'SubjectController@subjectList');
    Route::get('subjectstudents/subject/{subject}', 'SubjectController@subjectStudents');
    Route::post('subjectresult', 'MarksController@store');
    // route newly added
    // Route::resource('class', 'S5ClassController');
    Route::put('schclass/{key}','S5ClassController@store');
    
    Route::get('studentsclass/{id}','S5ClassController@stud_classes');
    Route::get('studentSubject/{id}','SubjectController@studentsubjects');
    // term structuring
    Route::post('term_class','TermController@term_class');
    // assignclass to term
    Route::get('terms/{term}/unassignedterms', 'TermController@unassignedClasses');
    Route::get('terms/{term}/assignedterms', 'TermController@assignedClasses');
    Route::post('term/{term}/assignclass/{class}', 'TermController@assignClass');
    Route::delete('terms/{term}/deleteclass/{class}', 'TermController@deleteClass');
    Route::get('terms_classes/{term}', 'TermController@termClasses');

    // subjectMArk Controller
     Route::get('subjectMarks/{student}','SubjectMarkController@show_Mark');
    //  update SubjectMark
    
    
});
