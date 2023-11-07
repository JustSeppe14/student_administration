<?php

namespace App\Livewire;

use App\Models\course;
use App\Models\programme;
use App\Models\studentCourses;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class Courses extends Component
{
    use WithPagination;

    public $perPage = 4;

    #[Layout('layouts.studentadministration',['title'=>'Courses','discription'=>'Welcome to our Student administration application'])]
    public function render()
    {

        $courses = Course::orderBy('name')
            ->with('programme')
            ->paginate($this->perPage);



        return view('livewire.course',compact('courses'));
    }
}
