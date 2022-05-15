<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Group;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $project = Project::first();

        if(!$project){
            return view('project.create');
        }

        $students = Student::all();
        $groups = Group::all();

        return view('project.view', compact('project', 'students', 'groups'));
    }

    public function create(CreateProjectRequest $request)
    {
        $numberOfGroups = $request->post('number_of_groups');

        $project = new Project();
        $project->name = $request->post('project_title');
        $project->groups = $numberOfGroups;
        $project->per_group = $request->post('students_per_group');

        $project->save();

        for($i = 0; $i < $numberOfGroups; $i++) {
            Group::create();
        }

        return redirect()->route('home')->withSuccess('Project created');
    }
}
