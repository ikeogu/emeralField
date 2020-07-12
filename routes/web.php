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
 // loggin student
 Route::get('/dashboard', 'StudentController@dashboard')->name('student.dashboard');
    
