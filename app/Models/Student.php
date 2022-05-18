<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function GetGroupAttribute()
    {
        return $this->groups->first();
    }
}
