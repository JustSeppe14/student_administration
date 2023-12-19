<?php

namespace App\Livewire\Forms;

use App\Models\Course;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CourseForm extends Form
{
    public $id = null;
    #[Validate('required', as: 'name of the course')]
    public $name = null;
    #[Validate('required', as: 'description of the course')]
    public $description = null;

    public $created_at = null;
    #[Validate('required|exists:programmes,id', as: 'programme')]
    public $programme_id = null;



    // read the selected record
    public function read($course)
    {
        $this->id = $course->id;
        $this->name = $course->name;
        $this->description = $course->description;
        $this->created_at = $course->created_at;
        $this->programme_id = $course->programme_id;
    }

    // create a new record
    public function create()
    {
        $this->validate();
        Course::create([
            'name' => $this->name,
            'description' => $this->description,
            'programme_id' => $this->programme_id,
            'created_at' => $this->created_at.now(),
        ]);
    }






}
