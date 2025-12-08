<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'classroom_id',
        'nisn',
        'name',
        'password',
        'gender'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
