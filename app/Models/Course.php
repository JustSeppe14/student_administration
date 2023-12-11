<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;
    public function student_courses()
    {
        return $this->hasMany(StudentCourses::class);
    }
    public function programme()
    {
        return $this->belongsTo(Programme::class)->withDefault();
    }

    protected function programmeName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes)=> Programme::find($attributes['programme_id'])->name,
        );
    }

    protected function studentId(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes)=> StudentCourses::where('course_id','like',$this['id'])->get()
        );
    }

    protected function studentName(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes)=> StudentCourses::where('course_id','like',$attributes['id'])->with('student')->get()
        );
    }


    protected $appends = ['programme_name','student_id','student_name'];
}
