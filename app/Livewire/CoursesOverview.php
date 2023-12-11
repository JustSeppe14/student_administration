<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Programme;
use App\Models\Student;
use App\Models\StudentCourses;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


class CoursesOverview extends Component
{
    use WithPagination;

    public $perPage = 6;
    public $name;
    public $programme = '%';




    public $loading = 'Loading courses...';
    public $selectedCourse;
    public $selectedProgramme;
    public $showModal = false;

    public function updated($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
        if (in_array($property, ['perPage', 'course', 'programme']))
            $this->resetPage();
    }

    public function showCourses(Course $course)
    {
        $this->selectedCourse = $course;
        $students = StudentCourses::where('course_id','like',$course->id)->with('student')->get();
        //dump($students->toArray());
        $this->selectedCourse['student'] = $students;
        //dump($this->selectedCourse->toArray());
        $this->showModal = true;
    }


    #[Layout('layouts.studentadministration',['title'=>'CoursesOverview','discription'=>'Welcome to our Student administration application'])]
    public function render()
    {
        $allProgrammes = Programme::has('courses')->withCount('courses')->get();
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
