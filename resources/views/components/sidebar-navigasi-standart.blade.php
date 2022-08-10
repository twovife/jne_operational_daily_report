@props(['active'])

@php
$classes = $active === true ? 'flex items-center p-2 w-full text-base font-semibold rounded-lg transition duration-75 group text-gray-900 bg-white dark:text-white dark:bg-gray-700' : 'flex items-center p-2 w-full text-base font-semibold text-white rounded-lg transition duration-75 group text-white hover:bg-gray-50 hover:bg-opacity-30 dark:text-white dark:hover:bg-gray-700 dark:hover:bg-opacity-40';
@endphp

<a type="button" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
