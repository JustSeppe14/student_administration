<?php

namespace App\Livewire;

use App\Models\courses;
use App\Models\programmes;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Course extends Component
{
    use WithPagination;

//    public $perPage = 4;
//    public $loading = 'Please wait...';
//    public $selectedCourse;
//
//    public $name;
//    public $programme;
//
//    public function updated($property, $value)
//    {
//        if (in_array($property, ['perPage','name','programme']))
//            $this->resetPage();
//    }
//
//    public function showInfo($course)
//    {
//        $this->selectedCourse = $course;
//        dump($this->selectedCourse->toArray());
//    }


    #[Layout('layouts.studentadministration',['title'=>'Courses','discription'=>'Welcome to our Student administration application'])]
    public function render()
    {
//        $allCourses = courses::has('programmes')->withCount('programmes')->get();
        $courses = courses::orderBy('name')
            ->with('programme')
            ->get();
        $programmes = programmes::orderBy('name')
            ->with('courses')
            ->get();
        $programmes->makeVisible('created_at');
        return view('livewire.course',compact('programmes','courses'));
    }
}
