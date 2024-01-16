@php use App\Models\Programme; @endphp

<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50"
         wire:loading>
        <x-tmk.preloader class="bg-green-500/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-tmk.preloader>
    </div>
    {{-- filter section: artist or title, genre, max price and records per page --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">
        <div>
            <x-label for="name" value="Filter"/>
            <div
                    class="relative">
                <x-input id="name" type="text"
                         wire:model.live.debounce.500ms="name"
                         class="block mt-1 w-full"
                         placeholder="Filter on course name or description"/>
                <button
                    @click="$wire.set('name','')"
                        class="w-5 absolute right-4 top-3">
                    <x-phosphor-x/>
                </button>
            </div>
        </div>
        <div>
            <x-label for="programme" value="Programme"/>
            <x-tmk.form.select id="programme"
                               wire:model.live="programme"
                               class="block mt-1 w-full">
                <option value="%">All Programmes</option>
                @foreach($allProgrammes as $p)
                    <option value="{{$p->id}}">
                        {{$p->name}}
                    </option>
                @endforeach
            </x-tmk.form.select>
        </div>
        <div>
            <x-label for="perPage" value="Records per page"/>
            <x-tmk.form.select id="perPage"
                               wire:model.live="perPage"
                               class="block mt-1 w-full">
                @foreach ([1,3,6,7] as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </x-tmk.form.select>
        </div>
    </div>
    {{-- master section: cards with paginationlinks --}}
    <div class="my-4">{{ $courses->links() }}</div>

    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">
        @foreach($courses as $course)
            <div
                    wire:key="course-{{$course->id}}"
                    class="flex bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
                <div class="flex-1 flex flex-col">
                    <div class="flex-1 p-4">
                        <p class="text-center font-sm text-sm border-b border-gray-300 h-10">{{$course->programme_name}}</p>
                        <p class="text-lg text-left font-medium">{{$course->name}}</p>
                        <p class="text-left pb-10 pt-10">{{$course->description}}</p>
                    </div>
                    @auth
                        <div class="flex justify-between border-t border-gray-300 px-4 py-2">
                            <div class="flex w-full justify-center">
                                @if(count($course->student_id)>0)
                                    <button class="w-full text-white bg-green-500 rounded-lg h-10"
                                            wire:click="showCourses({{ $course->id }})">
                                        <p>Manage students</p>
                                    </button>
                                @else
                                    <button class="w-full text-white bg-green-200 rounded-lg h-10"
                                            wire:click="showCourses({{ $course->id }})" disabled>
                                        <p>Manage students</p>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endauth
                </div>
                <x-tmk.livewire-log :courses="$courses"/>
            </div>
        @endforeach
    </div>

    <div class="my-4">{{ $courses->links() }}</div>
    {{-- No records found --}}
    @if($courses->isEmpty())
        @if($programme === '%')
            <x-tmk.alert type="danger" class="w-full">
                Can't find any course with <b>'{{ $name }}'</b> in any of the <b>programmes</b>.
            </x-tmk.alert>
        @else
            <x-tmk.alert type="danger" class="w-full">
                Can't find any course with <b>'{{ $name }}'</b> in the <b>'{{ $allProgrammes->where('id', $programme)->first()->name }}'</b> programme.
            </x-tmk.alert>
        @endif
    @endif

    {{-- Detail section --}}
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            <div class="border-b border-gray-300 pb-2 gap-4">
                <h1 class="font-bold text-3xl mb-3">
                    {{ $selectedCourse->name ?? '' }}
                </h1>
                <p class="text-sm mb-3">{{ $selectedCourse->description ?? '' }}</p>
            </div>
        </x-slot>
        <x-slot name="content">
            {{-- @dump($selectedCourse['student_name'] ?? '')--}}
            @isset($selectedCourse['student_name'])
                <table class="w-full text-left align-top">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($selectedCourse['student_name'] as $student)
                        <tr>
                            <td>{{ $student->student->first_name}} {{  $student->student->last_name }}
                                (semester {{ $student->semester }})
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endisset
        </x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
