<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class course extends Model
{
    use HasFactory;
    public function student_courses()
    {
        return $this->hasMany(studentCourses::class);
    }
    public function programme()
    {
        return $this->belongsTo(Programme::class)->withDefault();
    }

    protected function programmeName(): Attribute
    {
        return Attribute::make(
            get: fn($value,$attributes)=> programme::find($attributes['programme_id'])->name,
        );
    }

//    protected function studentName(): Attribute
//    {
//        return Attribute::make(
//            get: fn($value,$attributes)=> studentCourses::find($attributes['student_id'])->name,
//        );
//    }






    protected $appends = ['programme_name'];
}
