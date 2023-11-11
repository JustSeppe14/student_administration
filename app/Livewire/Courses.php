<?php

namespace App\Livewire;

use App\Models\course;
use App\Models\programme;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class Courses extends Component
{
    use WithPagination;

    public $perPage = 6;
    public $name;
    public $programme = '%';




    public $loading = 'Loading courses...';
    public $selectedRecord;
    public $showModal = false;

    public function updated($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
        if (in_array($property, ['perPage', 'course', 'programme']))
            $this->resetPage();
    }

    public function showTracks(Course $course)
    {
        $this->selectedRecord = $course;
        $this->showModal = true;
    }

    #[Layout('layouts.studentadministration',['title'=>'Courses','discription'=>'Welcome to our Student administration application'])]
    public function render()
    {
        $allProgrammes = programme::has('courses')->withCount('courses')->get();
        $courses = Course::orderBy('name')
            ->where([
                ['name','like',"%{$this->name}%"],
                ['programme_id','like',$this->programme]
            ])
            ->orWhere([
                ['description','like',"%{$this->name}%"],
                ['programme_id','like',$this->programme]
            ])
            ->with('programme')
            ->with('student_courses')
            ->paginate($this->perPage);


        return view('livewire.course',compact('courses','allProgrammes'));
    }
}
