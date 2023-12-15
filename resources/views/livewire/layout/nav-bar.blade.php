@php use App\Models\Programme; @endphp
<nav class="container mx-auto p-4 flex justify-between items-center">
    <div class="flex items-center space-x-2">
        <x-nav-link href="{{route('home')}}" :active="request()->routeIs('home')">Home</x-nav-link>
        @if(auth()->user())
            <x-nav-link href="{{route('admin.course')}}" :active="request()->routeIs('admin.course')">Courses
            </x-nav-link>
            @if(auth()->user()->admin)
                <x-nav-link href="{{route('admin.programmes')}}" :active="request()->routeIs('admin.programme')">
                    Programmes
                </x-nav-link>
            @endif
        @else
            <x-nav-link href="{{route('course')}}" :active="request()->routeIs('course')">Courses</x-nav-link>
        @endif


    </div>
    {{-- right navigation --}}
    <div class="relative flex items-center space-x-2">
        @if(auth()->user())
            {{--      Verberg de login & register optie      --}}
        @else
            {{--            Login en registreer optie terug laten zien als de user is uitgelpgd--}}
            <x-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                Login
            </x-nav-link>
            <x-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                Register
            </x-nav-link>
        @endif
        {{-- dropdown navigation--}}
        @auth
            <x-dropdown align="right" width="48">
                {{-- avatar --}}
                <x-slot name="trigger">
                    <img class="rounded-full h-8 w-8 cursor-pointer"
                         src="{{ $avatar }}"
                         alt="{{auth()->user()->name}}">
                </x-slot>
                <x-slot name="content">
                    {{-- all users --}}
                    <div class="block px-4 py-2 text-xs text-gray-400">{{auth()->user()->name}}</div>
                    <x-dropdown-link href="{{ route('dashboard') }}">Dashboard</x-dropdown-link>
                    <x-dropdown-link href="{{ route('profile.show') }}">Update Profile</x-dropdown-link>
                    <div class="border-t border-gray-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                            Logout
                        </button>
                    </form>
                    <div class="border-t border-gray-100"></div>
                    @if(auth()->user()->admin)
                        {{-- admins only --}}
                        <div class="block px-4 py-2 text-xs text-gray-400">Admin</div>
                        <x-dropdown-link href="{{ route('admin.programmes') }}">Programmes</x-dropdown-link>
                        <x-dropdown-link href="{{ route('admin.course') }}">Courses</x-dropdown-link>
                        <x-dropdown-link href="{{ route('under-construction') }}">Covers</x-dropdown-link>
                        <x-dropdown-link href="{{ route('under-construction') }}">Users</x-dropdown-link>
                        <x-dropdown-link href="{{ route('under-construction') }}">Orders</x-dropdown-link>
                    @endif
                </x-slot>
            </x-dropdown>
        @endauth
    </div>
</nav>

