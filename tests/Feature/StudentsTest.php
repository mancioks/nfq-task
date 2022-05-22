<?php

namespace Tests\Feature;

use App\Models\Group;
use App\Models\Project;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class StudentsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_delete_student()
    {
        // creating project and student
        $project = Project::query()->create(['name' => 'test', 'per_group' => 1]);
        $student = Student::query()->create(['name' => 'name lastname', 'project_id' => $project->id]);

        // db contains student
        $this->assertDatabaseHas('students', ['name' => $student->name]);

        // delete student
        $this->delete(route('student.destroy', $student));

        // db does not contain student
        $this->assertDatabaseMissing('students', ['name' => $student->name]);
    }

    public function test_delete_student_and_remove_from_group_and_project()
    {
        // creating project, group, student and relationship

        $project = Project::query()->create(['name' => 'test', 'per_group' => 1]);
        $group = Group::query()->create(['name' => 'Group Test', 'project_id' => $project->id]);
        $student = Student::query()->create(['name' => 'name lastname', 'project_id' => $project->id]);
        $student->groups()->attach($group);

        // group contains student
        $this->assertTrue($group->students->contains($student));
        // project contains student
        $this->assertTrue($project->students->contains($student));

        // delete student
        $this->delete(route('student.destroy', $student));

        // refresh group and project after student delete
        $group->refresh();
        $project->refresh();

        // group does not contain student
        $this->assertFalse($group->students->contains($student));
        // project does not contain student
        $this->assertFalse($project->students->contains($student));
    }
}
