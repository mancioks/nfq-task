<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function getAssignedSlotsAttribute()
    {
        return $this->students()->count();
    }

    public function getEmptySlotsAttribute()
    {
        $slots = Project::first()->per_group;

        return $slots - $this->assigned_slots;
    }
}
