<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'title',
        'date',
        'type'
    ];

    protected $dates = ['date'];

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
