
<div>
    {{-- show preloader while fetching data in the background --}}
    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50"
         wire:loading>
        <x-tmk.preloader class="bg-green-500/60 text-white border border-lime-700 shadow-2xl">
            {{ $loading }}
        </x-tmk.preloader>
    </div>
    {{-- filter section: artist or title, genre, max price and records per page --}}

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

                    <div class="flex justify-between border-t border-gray-300 px-4 py-2">
                        <div class="flex w-full justify-center">
{{--                            @if($course->student_id->count()>0)--}}
                            <button class="w-full text-white bg-green-500 rounded-lg h-10">
                                <p wire:click="showStudents({{$course->id}})">Manage students</p>
                            </button>
{{--                            @endif--}}
                        </div>
                    </div>

                </div>
                <x-tmk.livewire-log :courses="$courses" />
            </div>
        @endforeach
    </div>
    <div class="my-4">{{ $courses->links() }}</div>
    {{-- Detail section --}}
    <x-dialog-modal wire:model="showModal">
        <x-slot name="title">
            <p>{{$course->programme_name}}</p>
            <p>{{$course->description}}</p>
        </x-slot>
        <x-slot name="content">{{$course->student_name}}</x-slot>
        <x-slot name="footer"></x-slot>
    </x-dialog-modal>
</div>
