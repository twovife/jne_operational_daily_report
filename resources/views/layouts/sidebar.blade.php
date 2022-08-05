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

    @isset($css)
        {{ $css }}
    @endisset

    <style>
        label.required::after {
            content: "*";
            color: red;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.4.7/dist/flowbite.js"></script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 relative" x-data="{ open: false }">
        <aside
            class="w-64 z-10 h-screen lg:transform-none lg:opacity-100 bg-white fixed inset-0 transform duration-200 shadow"
            :class="{ '-translate-x-full ease-out opacity-0': !open, 'translate-x-0 ease-in opacity-100': open }"
            aria-label="Sidebar">
            <div class=" overflow-y-auto py-4 px-3 bg-gray-50 rounded dark:bg-gray-800">
                <div class="flex justify-between items-center drop-shadow mb-4 border-b py-5">
                    <a href="#">
                        <div class="space-y-1">
                            <div class="flex text-2xl items-center space-x-2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <h1>My Apps</h1>
                            </div>
                            <small>Data Center</small>
                        </div>
                    </a>
                    <button @click="open = false" class="flex justify-center p-2 rounded focus:bg-gray-300 lg:hidden">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path>
                        </svg>
                    </button>

                </div>
                <ul class="space-y-2">
                    @include('custom.operational-sidebar')
                </ul>
            </div>
        </aside>
        <div class="w-full space-y-4 lg:pl-64 relative">
            <nav id="navbar"
                class="bg-white border-gray-200 px-2 lg:px-4 py-2.5 dark:bg-gray-800 w-full h-14 shadow-sm">
                <div class="flex flex-wrap justify-start items-center mx-auto">
                    <button @click="open = !open" class="lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <div class="space-x-4 font-semibold text-sm text-gray-500 hidden lg:block">

                    </div>
                    <div class="flex items-center lg:order-2 ml-auto">
                        <button type="button"
                            class="flex mr-3 text-sm bg-transparent rounded-full lg:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                            <span class="sr-only">Open user menu</span>
                            <img class="w-8 h-8 rounded-full border-2 p-1 bg-transparent border-gray-500"
                                src="{{ asset('imgs/avatar.jpeg') }}" alt="user photo">
                        </button>

                        <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                            id="dropdown" data-popper-reference-hidden="" data-popper-escaped=""
                            data-popper-placement="top"
                            style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(1209px, 591px);">
                            <div class="py-3 px-4">
                                <span
                                    class="block text-sm text-gray-900 dark:text-white">{{ Auth::user()->name ?? '' }}</span>
                                <span
                                    class="block text-sm font-medium text-gray-500 truncate dark:text-gray-400">{{ Auth::user()->username ?? '' }}</span>
                            </div>
                            <ul class="py-1" aria-labelledby="dropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign
                                            out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="px-8 py-6">
                {{ $slot }}
            </div>
        </div>

        {{-- <div class="max-w-full w-full">

        </div> --}}


    </div>
</body>


@isset($javascript)
    <script>
        function removeIt(event) {
            // event.target.style.display = "none"
            console.log(event);
        }
    </script>
    {{ $javascript }}
@endisset

</html>
