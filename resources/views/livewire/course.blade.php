<div>
    <h2>Genres with records</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($programmes as $programme)
            <div class="flex space-x-4 bg-white shadow-md rounded-lg p-4">
                <div class="flex-none w-36 border-r border-gray-200">
                    <h3 class="font-bold text-xl">{{ $programme->name }}</h3>
                    <p>Has {{ $programme->courses()->count() }} {{ Str::plural('course', $programme->courses()->count()) }}</p>
                </div>
                <div>
                    @foreach($programme->courses() as $course)
                        <x-tmk.list class="list-outside ml-4">
                            <li>
                                <span class="font-bold">{{ $course->name }}</span><br>
                                {{ $course->name }}
                            </li>
                        </x-tmk.list>

                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <x-tmk.livewire-log :courses="$courses"/>
</div>
{{--@php use App\Models\programmes; @endphp--}}
{{--<div>--}}
{{--    --}}{{-- show preloader while fetching data in the background --}}
{{--    <div class="fixed top-8 left-1/2 -translate-x-1/2 z-50"--}}
{{--         wire:loading>--}}
{{--        <x-tmk.preloader class="bg-lime-700/40 text-white border border-lime-700 shadow-2xl">--}}
{{--            {{ $loading }}--}}
{{--        </x-tmk.preloader>--}}
{{--    </div>--}}
{{--    --}}{{-- filter section: artist or title, genre, max price and records per page --}}
{{--    <div class="grid grid-cols-9 gap-4">--}}
{{--        <div class="col-span-10 md:col-span-5 lg:col-span-3">--}}
{{--            <x-label for="name" value="Filter"/>--}}
{{--            <div--}}
{{--                class="relative">--}}
{{--                <x-input id="name" type="text"--}}
{{--                         class="block mt-1 w-full"--}}
{{--                         placeholder="Filter on course name or description"/>--}}
{{--                <button--}}
{{--                    class="w-5 absolute right-4 top-3">--}}
{{--                    <x-phosphor-x/>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-span-5 md:col-span-2 lg:col-span-3">--}}
{{--            <x-label for="genre" value="Programme"/>--}}
{{--            <x-tmk.form.select id="programme"--}}
{{--                               class="block mt-1 w-full">--}}
{{--                <option value="%">All Programmes</option>--}}
{{--                @foreach($allCourses as $c)--}}
{{--                    <option value="{{$c->id}}">--}}
{{--                        {{$c->name}} ({{$c->pro}}--}}
{{--                    </option>--}}
{{--                @endforeach--}}
{{--            </x-tmk.form.select>--}}
{{--        </div>--}}
{{--        <div class="col-span-5 md:col-span-3 lg:col-span-3">--}}
{{--            <x-label for="perPage" value="Courses per page"/>--}}
{{--            <x-tmk.form.select id="perPage"--}}
{{--                               wire:model.live="perPage"--}}
{{--                               class="block mt-1 w-full">--}}
{{--                @foreach ([2,4,6,7] as $value)--}}
{{--                    <option value="{{ $value }}">{{ $value }}</option>--}}
{{--                @endforeach--}}
{{--            </x-tmk.form.select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    --}}{{-- master section: cards with paginationlinks --}}
{{--    <div class="my-4">{{$allCourses->links()}}</div>--}}
{{--    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">--}}
{{--        @foreach($courses as $course)--}}
{{--        <div--}}
{{--            wire:key="course-{{$course->id}}"--}}
{{--            class="flex bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">--}}
{{--            <div class="flex-1 flex flex-col">--}}
{{--                <div class="flex-1 p-4">--}}
{{--                    <p class="text-lg font-medium p-1">{{$course->programme_id}}</p>--}}
{{--                    <p class="text-lg font-medium">{{$course->name}}</p>--}}
{{--                    <p class="italic pb-2">{{$course->description}}</p>--}}
{{--                </div>--}}
{{--                <div class="flex justify-center border-t border-gray-300 px-4 py-2">--}}
{{--                    <div class="flex w-full justify-center text-white bg-blue-300 rounded-lg" >--}}
{{--                        <button class="p-3 w-full">--}}
{{--                            <p wire:click="showCourse({{$course->id}}">Manage students</p>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <div class="my-4">{{$allCourses->links()}}</div>--}}
{{--    --}}{{-- Detail section --}}
{{--</div>--}}
