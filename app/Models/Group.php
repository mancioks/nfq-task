<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['project_id', 'name'];

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function getAssignedSlotsAttribute()
    {
        return $this->students()->count();
    }

    public function getEmptySlotsAttribute()
    {
        return $this->project->per_group - $this->assigned_slots;
    }
}
