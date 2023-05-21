<?php

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

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
    return view('Student.index');
});
//Route::get('project',[ProjectController::class,'project'])->name('project');
//Route::resource('project',ProjectController::class);

Route::get('student/getdata',[StudentsController::class,'getdata'])->name('student.getdata');
Route::post('student/delete',[StudentsController::class,'delete'])->name('student.delete');
Route::get('student/filterdata/{cityFilterId}',[StudentsController::class,'FilterData'])->name('student.filterdata');
Route::post('getdeveloper',[StudentsController::class,'getdeveloper'])->name('getdeveloper');
Route::post('editmodel',[StudentsController::class,'editmodel'])->name('editmodel');
Route::resource('student',StudentsController::class);
