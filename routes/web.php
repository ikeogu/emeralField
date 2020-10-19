<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
// Route::get('/{id}', function () {
//     return view('welcome');
// });
Auth::routes();

Route::view('students', 'students.index')->name('students.index');
Route::view('studentsubjects', 'students.subjects')->name('student.subjects');
Route::view('subjects', 'subjects.index')->name('subjects.index');
Route::view('grades', 'grades.index')->name('grades.index');
Route::view('marks', 'marks.index')->name('marks.index');
Route::view('results', 'results.studentList')->name('results.studentList');
Route::view('class','class.index')->name('class.index');
Route::view('term','class.term')->name('term');
Route::view('teachers','teacher.index')->name('teachers.index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout');
 // loggin student
 Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');
 Route::get('/teacher', 'TeacherController@dashboard')->name('teacher.dashboard');
 Route::get('hschool_students', 'StudentController@hschool')->name('hschool');
 Route::get('eschool_students', 'StudentController@eschool')->name('eschool');  
 Route::get('yschool_students', 'StudentController@yschool')->name('yschool');
//  Get Broad Sheet Ready
Route::get('summative_test/{term}/class/{class}','StudentController@summative')->name('summative');
Route::get('exam/{term}/class/{class}','StudentController@exam')->name('exam');
Route::get('grand_total/{term}/class/{class}','StudentController@grandTotal')->name('gt');
Route::get('tca/{term}/class/{class}','StudentController@tca')->name('tca');
 Route::get('stud_in_class', 'TeacherController@sub_class')->name('stud_in_class');

Route::get('summative/stud/{student}/term/{term}/class/{class}','StudentController@summative_sheet')->name('sum');
Route::get('cat/stud/{student}/term/{term}/class/{class}','StudentController@cat1')->name('cat1');
Route::get('cat2/stud/{student}/term/{term}/class/{class}','StudentController@cat2')->name('cat2');
Route::get('result/stud/{student}/term/{term}/class/{class}','StudentController@result_sheet')->name('result');

// Route::view('high_sch', 'results.h_result')->name('res');