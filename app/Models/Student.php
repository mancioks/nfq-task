<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_id'];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function project()
    {
        return $this->hasOne(Project::class, 'id', 'project_id');
    }

    public function getGroupAttribute()
    {
        return $this->groups->first();
    }
}
