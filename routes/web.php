<?php

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

Route::get('/', [App\Http\Controllers\ProjectController::class, 'index'])->name('home');

Route::post('/project/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');

Route::group(['middleware' => 'project.created'], function() {
    Route::delete('/student/{student}', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/student/{student}/assign/{group}', [\App\Http\Controllers\StudentController::class, 'assign'])->name('student.assign');

    Route::get('student/component/list', function (){
        return view('student.components.list', ['students' => \App\Models\Student::all()]);
    })->name('student.component.list');

    Route::get('project/component/groups', function (){
        return view('project.components.groups', ['unasignedStudents' => \App\Models\Student::whereDoesntHave('groups')->get(), 'groups' => \App\Models\Group::all()]);
    })->name('project.component.groups');
});
