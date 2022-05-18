<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function store(StoreStudentRequest $request)
    {
        $student = new Student();
        $student->name = $request->post('student_name');
        $student->save();

        return $student;
    }

    public function destroy(Student $student)
    {
        $student->delete();

        DB::table('group_student')->where('student_id', $student->id)->delete();

        return redirect()->route('home')->withSuccess('Student deleted successfully');
    }

    public function assign(Student $student, Group $group)
    {
        if($group->empty_slots == 0)
            return redirect()->route('home')->withError('Group #'. $group->id .' is full');

        if($student->group)
            return redirect()->route('home')->withError('Student '.$student->name.' has a group');

        DB::table('group_student')->insert([
            'group_id' => $group->id,
            'student_id' => $student->id
        ]);

        return redirect()->route('home')->withSuccess('Student '.$student->name.' assigned to Group #'.$group->id);
    }
}
