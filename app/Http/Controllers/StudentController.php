<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Project;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function store(StoreStudentRequest $request)
    {
        return Student::query()->create([
            'name' => $request->post('student_name'),
            'project_id' => $request->post('project_id')
        ]);
    }

    public function destroy(Student $student)
    {
        $project = $student->project;
        $student->delete();

        return redirect()->route('project.show', $project)->withSuccess('Student deleted successfully');
    }

    public function assign(Student $student, Group $group)
    {
        if ($group->empty_slots === 0)
            return redirect()->route('project.show', $group->project)->withError(sprintf('%s is full', $group->name));

        if ($student->groups()->exists())
            return redirect()->route('project.show', $student->project)->withError(sprintf('Student %s has a group', $student->name));

        if ($student->project != $group->project)
            return redirect()->route('project.show', $group->project)->withError(sprintf('Student %s belongs to other project', $student->name));


        $student->groups()->attach($group);

        return redirect()->route('project.show', $student->project)->withSuccess(sprintf('Student %s assigned to %s', $student->name, $group->name));
    }
}
