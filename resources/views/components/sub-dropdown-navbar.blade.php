@props(['active'])

@php
$classes = $active === true ? 'flex items-center p-2 w-full text-base font-normal rounded-lg transition duration-75 group text-gray-900 bg-white dark:text-white dark:bg-gray-700' : 'flex items-center p-2 w-full text-base font-normal text-white rounded-lg transition duration-75 group hover:text-gray-900 hover:bg-white dark:text-white dark:hover:bg-gray-700';
@endphp

<a type="button" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
