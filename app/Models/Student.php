<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function getGroupAttribute()
    {
        return $this->groups->first();
    }

    protected static function boot() {
        parent::boot();

        static::deleting(function($student) {
            DB::table('group_student')->where('student_id', $student->id)->delete();
        });
    }
}
