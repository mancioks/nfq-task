<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

//    public function students()
//    {
//        return $this->hasMany(Student::class, 'group_id', 'id');
//    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function GetAssignedSlotsAttribute()
    {
        return $this->students()->count();
    }

    public function GetEmptySlotsAttribute()
    {
        $slots = Project::first()->per_group;

        return $slots - $this->assigned_slots;
    }
}
