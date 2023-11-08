<?php

namespace App\Livewire;

use App\Models\course;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class Courses extends Component
{
    use WithPagination;

    public $perPage = 4;
    public $loading = 'Loading courses...';
    public $selectedCourse;
    public $showModel = false;

    public function showStudents($course)
    {
        $this->selectedCourse = $course;
        $this->showModel = true;
    }

    #[Layout('layouts.studentadministration',['title'=>'Courses','discription'=>'Welcome to our Student administration application'])]
    public function render()
    {

        $courses = Course::orderBy('name')
            ->with('programme')
            ->with('student_courses')
            ->paginate($this->perPage);


        return view('livewire.course',compact('courses'));
    }
}
