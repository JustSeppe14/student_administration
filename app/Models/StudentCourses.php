<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentCourses extends Model
{
    use HasFactory;

    public function student()
    {
        return $this->belongsTo(student::class)->withDefault();
    }
    public function courses()
    {
        return $this->belongsTo(course::class)->withDefault();
    }
}
