<x-sidebar-layout>



    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Input Data Undel
            </h2>
            <div class="flex justify-start">
                <a role="button" href="{{ route('opr.daily-report.undel.index') }}"
                    class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </div>

    @if (Session::has('errors'))
        <div class="p-4 mb-3 text-sm text-rose-700 bg-rose-100 rounded-lg dark:bg-rose-200 dark:text-rose-800"
            role="alert">
            <div class="text-lg text-red-600">
                {{ __('Whoops! Terjadi Kesalahan .') }}
            </div>
            @foreach ($errors->all() as $error)
                <span class="font-medium">- </span> {{ $error }}
            @endforeach
        </div>
    @endif







</x-sidebar-layout>
