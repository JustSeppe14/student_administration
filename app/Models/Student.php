<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    public function student_courses()
    {
        return $this->hasMany(studentCourses::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value)=>ucfirst($value),
            set: fn($value)=>strtolower($value),
        );
    }
}
