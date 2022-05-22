<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'per_group'];

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function getUnasignedStudentsAttribute()
    {
        return $this->students()->whereDoesntHave('groups')->get();
    }

    public function getNumberOfGroupsAttribute()
    {
        return $this->groups()->count();
    }
}
