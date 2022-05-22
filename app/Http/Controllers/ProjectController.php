<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Models\Group;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function show(Project $project)
    {
        return view('project.view', compact('project'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function list()
    {
        if (Project::exists()) {
            return view('project.list', ['projects' => Project::all()]);
        } else {
            return redirect()->route('project.create');
        }
    }

    public function store(CreateProjectRequest $request)
    {
        $project = Project::query()->create([
            'name' => $request->post('project_title'),
            'per_group' => $request->post('students_per_group')
        ]);

        for ($i = 1; $i <= $request->post('number_of_groups'); $i++) {
            Group::query()->create([
                'name' => sprintf('Group #%d', $i),
                'project_id' => $project->id,
            ]);
        }

        return redirect()->route('project.show', $project)->withSuccess('Project created');
    }

    public function studentsListComponent(Project $project)
    {
        return view('student.components.list', compact('project'));
    }

    public function groupsListComponent(Project $project)
    {
        return view('project.components.groups', compact('project'));
    }
}
