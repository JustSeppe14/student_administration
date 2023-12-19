<div>
    <x-tmk.section
        x-data="{open: false}"
        class="p-0 mb-4 flex flex-col gap-2">
        <div class="p-4 flex justify-between items-start gap-4">
            <div class="relative w-64">
                <x-input id="newProgramme" type="text" placeholder="New programme"
                         @keydown.enter="$el.setAttribute('disabled', true); $el.value = '';"
                         @keydown.tab="$el.setAttribute('disabled', true); $el.value = '';"
                         @keydown.esc="$el.setAttribute('disabled', true); $el.value = '';"
                         wire:model="newProgramme"
                         wire:keydown.enter="create()"
                         wire:keydown.tab="create()"
                         wire:keydown.escape="resetValues()"
                         class="w-full shadow-md placeholder-gray-300"/>
                <x-phosphor-arrows-clockwise
                    wire:loading
                    wire:target="create"
                    class="w-5 h-5 text-gray-500 absolute top-3 right-2 animate-spin"/>
            </div>
            <x-heroicon-o-information-circle
                @click="open !=open"
                class="w-5 text-gray-400 cursor-help outline-0"/>
        </div>
        <x-input-error for="newProgramme" class="m-4 -mt-4 w-full"/>
        <div
            x-show="open"
            x-transition
            style="display: none"
            class="text-sky-900 bg-sky-50 border-t p-4">
            <x-tmk.list type="ul" class="list-outside mx-4 text-sm">
                <li>
                    <b>A new programme</b> can be added by typing in the input field and pressing <b>enter</b> or
                    <b>tab</b>. Press <b>escape</b> to undo.
                </li>
                <li>
                    <b>Edit a programme</b> by clicking the
                    <x-phosphor-pencil-line-duotone class="w-5 inline-block"/>
                    icon or by clicking on the programme name. Press <b>enter</b> to save, <b>escape</b> to undo.
                </li>
                <li>
                    Clicking the
                    <x-heroicon-o-information-circle class="w-5 inline-block"/>
                    icon will toggle this message on and off.
                </li>
            </x-tmk.list>
        </div>
    </x-tmk.section>

    <x-tmk.section>
        <div>
            <x-label for="perPage" value="Records per page"/>
            <x-tmk.form.select id="perPage"
                               wire:model.live="perPage"
                               class="block mt-1 w-full">
                @foreach ([1,3,5] as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </x-tmk.form.select>
        </div>
        <div class="my-4">{{ $programmes->links() }}</div>
        <table class="text-center w-full border border-gray-300">
            <colgroup>
                <col class="w-14">
                <col class="w-1/5">
                <col class="w-20">
                <col class="w-max">
            </colgroup>

            <thead>
            <tr class="bg-gray-100 text-gray-700 [&>th]:p-2 cursor-pointer">
                <th wire:click="resort('id')">
                    <span data-tippy-content="Order by id">#</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'id' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
                <th wire:click="resort('courses_count')">
                <span data-tippy-content="Order by # courses">
                    Amount of courses
                </span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'courses_count' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
                <th></th>
                <th wire:click="resort('name')" class="text-left">
                    <span data-tippy-content="Order by programme">Programme</span>
                    <x-heroicon-s-chevron-up
                        class="w-5 text-slate-400
                            {{$orderAsc ?: 'rotate-180'}}
                            {{$orderBy === 'name' ? 'inline-block' : 'hidden'}}
                        "/>
                </th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($programmes as $programme)
                <tr
                    wire:key="programme-{{$programme->id}}"
                    class="border-t border-gray-300 [&>td]:p-2">
                    <td>{{$programme->id}}</td>
                    <td>{{$programme->courses_count}}</td>
                    <td></td>
                    @if($editProgramme['id'] !== $programme->id)
                        <td
                            wire:click="edit({{$programme->id}})"
                            class="text-left cursor-pointer">{{$programme->name}}
                        </td>
                    @else
                        <td>
                            <div class="flex flex-col text-left w-64">
                                <x-input id="edit_{{ $programme->id }}" type="text"
                                         x-init="$el.focus()"
                                         @keydown.enter="$el.setAttribute('disabled', true);"
                                         @keydown.tab="$el.setAttribute('disabled', true);"
                                         @keydown.esc="$el.setAttribute('disabled', true);"
                                         wire:model="editProgramme.name"
                                         wire:keydown.enter="update({{$programme->id}})"
                                         wire:keydown.tab="update({{$programme->id}})"
                                         wire:keydown.escape="resetValues()"
                                         class="w-64"/>

                                <x-input-error for="editProgramme.name" class="mt-2"/>
                                <x-phosphor-arrows-clockwise
                                    wire:loading
                                    wire:target="update({{$programme->id}})"
                                    class="w-5 h-5 text-gray-500 absolute animate-spin"/>
                            </div>
                        </td>
                    @endif
                    <td>
                        @if($editProgramme['id']!== $programme->id)
                            <div class="flex gap-1 justify-end [&>*]:cursor-pointer [&>*]:outline-0 [&>*]:transition">
                                <x-phosphor-pencil-line-duotone
                                    wire:click="edit({{$programme->id}})"
                                    class="w-5 text-gray-300 hover:text-green-600"/>
                                <x-phosphor-book
                                    wire:click="newCourse({{$programme->id}})"
                                    class="w-5 text-gray-300 hover:text-gray-600"/>
                                <x-phosphor-trash-duotone
                                    @click="$dispatch('swal:confirm', {
                                        title: 'Delete {{ $programme->name }}?',
                                        icon: '{{ $programme->courses_count > 0 ? 'warning' : '' }}',
                                        background: '{{ $programme->courses_count > 0 ? 'error' : '' }}',
                                        html: '{{ $programme->courses_count > 0 ?
                                            '<b>ATTENTION</b>: you are going to delete <b>' . $programme->courses_count . ' ' . Str::plural('record', $programme->courses_count) . '</b> at the same time!' :'' }}',
                                        color: '{{ $programme->courses_count > 0 ? 'red' : '' }}',
                                        cancelButtonText: 'NO!',
                                        confirmButtonText: 'YES DELETE THIS PROGRAMME',
                                        next: {
                                            event: 'delete-programme',
                                            params: {
                                                id: {{ $programme->id }}
                                            }
                                        }
                                    })"
                                    class="w-5 text-gray-300 hover:text-red-600"/>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">{{ $programmes->links() }}</div>
    </x-tmk.section>

    {{-- Modal for add a course --}}
    <x-dialog-modal id="recordModal"
                    wire:model.live="showModal">
        <x-slot name="title">
            <h2>IT Factory</h2>
            @isset($selectedProgramme['course'])
                <table class="w-full text-left align-top">
                    <thead>
                    </thead>
                    <tbody>
                    @foreach($selectedProgramme['course'] as $programme)
                        <tr>
                            <td>{{ $programme->name}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endisset
            <h1 class="border-b">Add a course to the IT Factory programme</h1>
        </x-slot>
        <x-slot name="content">
            {{-- error messages --}}
            @if ($errors->any())
                <x-tmk.alert type="danger">
                    <x-tmk.list>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </x-tmk.list>
                </x-tmk.alert>
            @endif
            {{-- show only if $form->id is empty --}}
            <div class="flex flex-row gap-4 mt-4">
                <div class="flex-1 flex-col gap-2">
                    <x-label for="name" value="Name" class="mt-4"/>
                    <x-input id="name" type="text"
                             wire:model="form.name"
                             class="mt-1 block w-full"/>
                    <x-label for="description" value="Description" class="mt-4"/>
                    <x-input id="description" type="text"
                             wire:model="form.description"
                             class="mt-1 block w-full"/>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button @click="$wire.showModal = false">Cancel</x-secondary-button>
            <x-tmk.form.button color="success"
                               wire:click="createCourse()"
                               class="ml-2">Add new course
            </x-tmk.form.button>
        </x-slot>
    </x-dialog-modal>



</div>

