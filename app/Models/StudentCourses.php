<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCourses extends Model
{
    use HasFactory;


    public function student()
    {
        return $this->belongsTo(Student::class)->withDefault();
    }
    public function courses()
    {
        return $this->belongsTo(Course::class)->withDefault();
    }

}
