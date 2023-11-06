<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class courses extends Model
{
    use HasFactory;
    public function student_courses()
    {
        return $this->hasMany(student_courses::class);
    }
    public function programme()
    {
        return $this->belongsTo(programmes::class)->withDefault();
    }
}
