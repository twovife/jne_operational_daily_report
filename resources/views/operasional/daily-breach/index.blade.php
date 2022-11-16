<x-sidebar-layout>

    @if (session()->has('green'))
        <x-alert-message :message="session('green')" :color="'green'"></x-alert-message>
    @endif
    @if (session()->has('yellow'))
        <x-alert-message :message="session('yellow')" :color="'yellow'"></x-alert-message>
    @endif


    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Filters
            </h2>
        </div>
        <form action="{{ route('opr.breach.index') }}">
            <div class="grid lg:grid-cols-6 mb-3 space-x-3">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date
                        From</label>
                    <input type="date" name="from"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="John" value="{{ request('from') }}">
                </div>
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date
                        Thru</label>
                    <input type="date" name="thru"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="John" value="{{ request('thru') }}">
                </div>
                <div>
                    <label for="hub" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select
                        an
                        option</label>
                    <select id="hub" name="hub"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="">Choose a HUB</option>
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end space-x-3">
                    <button type="submit"
                        class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Search</button>
                </div>
            </div>
        </form>
    </div>
    <div class="rounded bg-white px-4 py-3 w-full">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Performa Delivery
            </h2>
            <div class="flex justify-start space-x-2">
                <a role="button" href="{{ route('opr.breach.create') }}"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    Create
                </a>
                {{-- <form action="{{ route('opr.undel.create') }}" method="GET">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="thru" value="{{ request('thru') }}">
                    <input type="hidden" name="hub" value="{{ request('hub') }}">
                    <button type="submit"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                        Export</button>

                </form> --}}
                @if (request('from'))
                    <x-btn-action onclick="downloadIt()" type="button" :btntype="'success'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        <x-btn-label>Export</x-btn-label>
                    </x-btn-action>
                @endif
                <form id="exportReport" action="{{ route('opr.breach.download') }}" method="GET">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="thru" value="{{ request('thru') }}">
                    <input type="hidden" name="hub" value="{{ request('hub') }}">
                </form>
            </div>
        </div>


        <div class="rounded bg-white px-4 py-3 w-full">
            <div class="overflow-x-auto relative">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-center">
                            <th scope="col" class="py-3 px-6">
                                Edit
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Source
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Date
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Inbound Date
                            </th>
                            <th scope="col" class="py-3 px-6">
                                HUB
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Origin
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Status Breach
                            </th>
                            <th scope="col" class="py-3 px-6">
                                No AWB
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Reason
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($datas as $data)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ $data->undelivery ? route('opr.undel.edit', $data->undelivery->id) : route('opr.breach.edit', $data->id) }}"
                                        class="flex justify-center items-center text-indigo-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </a>
                                </th>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $data->undelivery ? 'Undel' : 'Arrival Breach' }}
                                </th>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $data->date }}
                                </th>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $data->undelivery->date_inbound ?? $data->arrivebreach->date_inbound }}
                                </th>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $data->undelivery->hub ?? $data->arrivebreach->hub }}
                                </th>
                                <th scope="row"
                                    class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $data->undelivery->origin ?? $data->arrivebreach->origin }}
                                </th>
                                <td class="py-4 px-6">
                                    {{ $data->status }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $data->undelivery->no_awb ?? $data->arrivebreach->no_awb }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $data->reason }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="px-6 py-2">
            {{ $datas->links() }}
        </div>

    </div>

    <x-slot name="javascript">
        <script>
            function downloadIt() {
                document.getElementById('exportReport').submit()
            }
        </script>
    </x-slot>
</x-sidebar-layout>
