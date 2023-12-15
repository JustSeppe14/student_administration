<?php

namespace App\Livewire\Admin;

use App\Models\programme;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use App\Livewire\Forms\CourseForm;

class Programmes extends Component
{
    use WithPagination;
    public $perPage = 5;
    //sort properties
    public $orderBy = 'name';
    public $orderAsc = true;

    public $showModal = false;
    public CourseForm $form;

    public function newCourse()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }
    public function createCourse()
    {
        $this->form->create();
        $this->showModal = false;
        $this->dispatch('swal:toast', [
            'background'=>'success',
            'html'=>"The course <b><i>{$this->form->name}</i></b> has been added",
        ]);
    }

    public function updated($property, $value)
    {
        // $property: The name of the current property being updated
        // $value: The value about to be set to the property
        if (in_array($property, ['perPage']))
            $this->resetPage();
    }

    #[Validate('required|min:3|max:30|unique:programmes,name',
                as: 'name for this programme',)]
    public $newProgramme;

    #[Validate([
        'editProgramme.name' => 'required|min:3|max:30|unique:programmes,name',
    ], as: [
        'editProgramme.name' => 'name for this programme',
    ])]
    public $editProgramme = ['id' => null, 'name' => null];

    // reset all the values and error messages
    public function resetValues()
    {
        $this->reset('newProgramme','editProgramme');
        $this->resetErrorBag();
    }

    // copy the selected genre to $editGenre
    public function edit(Programme $programme)
    {
        $this->editProgramme = [
            'id' => $programme->id,
            'name' => $programme->name,
        ];
    }

    //update the programme
    public function update(Programme $programme)
    {
        $this->editProgramme['name'] = trim($this->editProgramme['name']);
        //if name is not changed, do nothing
        if (strtolower($this->editProgramme['name']) === strtolower($programme->name)){
            $this->resetValues();
            return;
        }
        $this->validateOnly('editProgramme.name');
        $oldName = $programme->name;
        $programme->update([
            'name'=>trim($this->editProgramme['name']),
        ]);
        $this->resetValues();
        $this->dispatch('swal:toast',[
            'background' => 'success',
            'html' => "The programme <b><i>{$oldName}</i></b> has been updated to <b><i>{$programme->name}</i></b>,"
        ]);
    }

    // create a new programme
    public function create()
    {
        // validate the new genre name
        $this->validateOnly('newProgramme');
        // create the genre
        $programme = Programme::create([
            'name' => trim($this->newProgramme),
        ]);
        //reset $newProgramme
        $this->resetValues();
        // toast
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The genre <b><i>{$programme->name}</i></b> has been added",
        ]);
    }

    // delete a genre
    #[On('delete-programme')]
    public function delete($id)
    {
        $programme = Programme::findOrFail($id);
        $programme->delete();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The genre <b><i>{$programme->name}</i></b> has been deleted",
        ]);
    }


    #[Layout('layouts.studentadministration', ['title' => 'Programmes', 'description' => 'Manage the programmes of your courses',])]
    public function render()
    {
        $programmes = programme::withCount('courses')
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            -> paginate($this->perPage);
        $programme = Programme::orderBy('name')->get();
        return view('livewire.admin.programmes',compact('programmes','programme'));
    }
    public function resort($column)
    {
        $this->orderBy === $column ?
            $this->orderAsc = !$this->orderAsc :
            $this->orderAsc = true;
        $this->orderBy = $column;
    }
}
