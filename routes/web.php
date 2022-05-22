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

Route::get('/', [App\Http\Controllers\ProjectController::class, 'list'])->name('home');

Route::get('/project/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
Route::post('/project/store', [\App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');

Route::group(['middleware' => 'project.created'], function () {
    Route::delete('/student/{student}', [\App\Http\Controllers\StudentController::class, 'destroy'])->name('student.destroy');
    Route::get('/student/{student}/assign/{group}', [\App\Http\Controllers\StudentController::class, 'assign'])->name('student.assign');

    Route::get('/project/{project}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('project.show');
    Route::get('project/{project}/component/studentslist', [\App\Http\Controllers\ProjectController::class, 'studentsListComponent'])->name('project.component.studentslist');
    Route::get('project/{project}/component/groupslist', [\App\Http\Controllers\ProjectController::class, 'groupsListComponent'])->name('project.component.groupslist');
});
