<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>
    <style>
        body {
            /* background-color: transparent; */
            height: 100vh;
            background-image: linear-gradient(to right top, #3853fb, #3a66fb, #4677f9, #5687f5, #6a96f0, #63a5f5, #62b2f7, #69bff8, #52cffe, #41dfff, #46eefa, #5ffbf1);
        }
    </style>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>

@isset($js)
    {{ $js }}
@endisset

</html>
