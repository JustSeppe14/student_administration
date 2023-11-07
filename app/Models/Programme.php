<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class programme extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->hasMany(course::class);
    }
    public function students()
    {
        return $this->hasMany(student::class);
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
