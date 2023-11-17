@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 border-t-4 border-dotted border-green-500 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-green-700 transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-2 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-green-300 focus:outline-none focus:text-gray-700 focus:border-green-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
