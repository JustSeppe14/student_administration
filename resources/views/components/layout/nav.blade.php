<nav class="container mx-auto p-4 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <x-nav-link href="{{route('home')}}" :active="request()->routeIs('home')">Home</x-nav-link>
        <x-nav-link href="{{route('courses')}}" :active="request()->routeIs('courses')">Courses</x-nav-link>
    </div>
</nav>
