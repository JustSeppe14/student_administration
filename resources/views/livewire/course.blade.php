
<div>
    {{-- show preloader while fetching data in the background --}}

    {{-- filter section: artist or title, genre, max price and records per page --}}

    {{-- master section: cards with paginationlinks --}}
    <div class="my-4">{{ $courses->links() }}</div>
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">

        @foreach($courses as $course)
            <x-tmk.section>

                <pre>@json($course, JSON_PRETTY_PRINT)</pre>
            </x-tmk.section>
        @endforeach
            {{-- @foreach($programmes as $programme)
            @foreach($programme->courses as $course)
                <div
                    wire:key="course-{{$programme->id}}"
                    class="flex bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <div class="flex-1 flex flex-col">

                <div class="flex-1 p-4">
                    <p class="text-center font-sm ">{{$programme->name}}</p>
                    <p class="text-lg font-medium">{{$course->name}}</p>
                    <p class="pb-2 text-left">{{$course->description}}</p>
                </div>

                <div class="flex justify-between border-t border-gray-300 bg-gray-100 px-4 py-2">
                    <div class="flex w-full justify-center">

                        <button class="w-full">
                            <p>Manage students</p>
                        </button>

                    </div>
                </div>

            </div>
        </div>
            @endforeach
        @endforeach--}}
    </div>
    <div class="my-4">{{ $courses->links() }}</div>
    {{-- Detail section --}}
</div>
