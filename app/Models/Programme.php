<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }



    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn($value)=>ucfirst($value),
            set: fn($value)=>strtolower($value),
        );
    }

    protected $hidden = ['created_at', 'updated_at'];
}
