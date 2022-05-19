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
        DB::table('projects')->insert(['name' => 'test', 'groups' => 1, 'per_group' => 1]);
        DB::table('students')->insert(['name' => 'name lastname']);

        $student = Student::first();

        // db contains student
        $this->assertDatabaseHas('students', ['name' => $student->name]);

        $this->delete(route('student.destroy', $student));

        // db does not contain student
        $this->assertDatabaseMissing('students', ['name' => $student->name]);
    }

    public function test_delete_student_and_remove_from_group()
    {
        // creating project, group, student and relationship
        DB::table('projects')->insert(['name' => 'test', 'groups' => 1, 'per_group' => 1]);
        DB::table('groups')->insert(['id' => 1]);
        DB::table('students')->insert(['name' => 'name lastname']);
        DB::table('group_student')->insert(['group_id' => 1, 'student_id' => 1]);

        $student = Student::first();
        $group = Group::first();

        // group contains student
        $this->assertTrue($group->students->contains($student));

        $this->delete(route('student.destroy', $student));

        // load group after student delete
        $group = Group::first();

        // group does not contain student
        $this->assertFalse($group->students->contains($student));
    }
}
