<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'birthdate'
    ];

    protected $dates = ['birthdate'];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    public function averageGrade()
    {
        return $this->grades->avg('grade') ?? 0;
    }
}
