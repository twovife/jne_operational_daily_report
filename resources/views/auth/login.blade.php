<x-guest-layout>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />



    <div class="flex max-w-3xl bg-transparent mx-auto h-screen items-center justify-center">

        <div class="grid md:grid-cols-2 w-5/6 md:w-full shadow-sm items-center p-5 md:p-0 h-full">
            <div class="rounded-l-md bg-gray-700 p-5 h-1/2 hidden md:flex md:flex-col justify-center">
                <p class="text-2xl text-white font-semibold">Selamat Datang !</p>
                <p class="text-white">Di Pusat Data Kita</p>
                <small class="text-gray-100">Jangan lupa untuk berdoa sebelum memulai pekerjaan hari ini.</small>
            </div>
            <div class="rounded-r-md bg-white p-5 bg-opacity-20 h-1/2 flex flex-col justify-around">
                @if ($errors->any())
                    <div class="bg-rose-400 p-3 rounded bg-opacity-70">
                        <div class="font-medium text-gray-900">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>

                        <ul class="mt-3 list-disc list-inside text-sm text-gray-900">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="bg-rose-400 p-3 rounded bg-opacity-70">
                        <div class="mt-3 list-disc list-inside text-sm text-gray-900">
                            {{ session('status') }}
                        </div>
                    </div>
                @endisset

                <form method="POST" action="{{ route('login') }}">
                    <h1 class="text-gray-900 text-2xl font-semibold mb-3">Login</h1>
                    @csrf

                    <!-- Username Address -->
                    <div>
                        <x-label for="username" :value="__('username')" />

                        <x-input id="username" class="block mt-1 w-full" type="text" name="username"
                            :value="old('username')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <button class="text-gray-800 underline" type="button" data-modal-toggle="popup-modal">
                                Lupa Password
                            </button>
                        @endif

                        <x-button class="ml-3">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
        </div>
    </div>
</div>

<div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="popup-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="p-6 text-center">
                <svg class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Mohon Wa IT ya 😁</h3>
                <button data-modal-toggle="popup-modal" type="button"
                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                    Oke
                </button>
            </div>
        </div>
    </div>
</div>

</x-guest-layout>
