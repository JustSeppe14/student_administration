<nav class="container mx-auto p-4 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <x-nav-link href="{{route('home')}}" :active="request()->routeIs('home')">Home</x-nav-link>
        <x-nav-link href="{{route('course')}}" :active="request()->routeIs('course')">Courses</x-nav-link>
    </div>
</nav>
