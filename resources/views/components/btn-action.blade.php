@props(['disabled' => false, 'btntype' => 'primary'])

@php
switch ($btntype) {
    case 'primary':
        $classes = $disabled === false ? 'flex items-center gap-1 text-white  bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800' : 'flex items-center gap-1 text-white  bg-indigo-400 dark:bg-indigo-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center';
        break;
    case 'success':
        $classes = $disabled === false ? 'flex items-center gap-1 text-white  bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-emerald-600 dark:hover:bg-emerald-700 focus:outline-none dark:focus:ring-emerald-800' : 'flex items-center gap-1 text-white  bg-emerald-400 dark:bg-emerald-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center';
        break;
    case 'warn':
        $classes = $disabled === false ? 'flex items-center gap-1 text-white  bg-amber-700 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-amber-600 dark:hover:bg-amber-700 focus:outline-none dark:focus:ring-amber-800' : 'flex items-center gap-1 text-white  bg-amber-400 dark:bg-amber-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center';
        break;
    case 'danger':
        $classes = $disabled === false ? 'flex items-center gap-1 text-white  bg-rose-700 hover:bg-rose-800 focus:ring-4 focus:ring-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-rose-600 dark:hover:bg-rose-700 focus:outline-none dark:focus:ring-rose-800' : 'flex items-center gap-1 text-white  bg-rose-400 dark:bg-rose-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center';
        break;

    default:
        $classes = $disabled === false ? 'flex items-center gap-1 text-white  bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800' : 'flex items-center gap-1 text-white  bg-indigo-400 dark:bg-indigo-500 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center';
        break;
}

@endphp

<button type="submit" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'type' => 'button',
    'class' => $classes,
]) !!}>{{ $slot }}
</button>
