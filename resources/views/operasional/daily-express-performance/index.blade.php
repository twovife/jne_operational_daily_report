<x-sidebar-layout>

    @if (session()->has('green'))
        <x-alert-message :message="session('green')" :color="'green'"></x-alert-message>
    @endif
    @if (session()->has('yellow'))
        <x-alert-message :message="session('yellow')" :color="'yellow'"></x-alert-message>
    @endif



    <div class="rounded bg-white dark:bg-gray-800 dark:text-white p-4 w-full">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl">
                Filters
            </h2>
        </div>
        <form action="{{ route('opr.dailyperformance.express.index') }}">
            <div class="grid lg:grid-cols-6 mb-3 space-y-2 lg:space-y-0 space-x-0 lg:space-x-2">
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

                        @if (request('hub'))
                            <option value="{{ request('hub') }}">{{ request('hub') }}</option>
                        @endif
                        <option value="">Choose a HUB</option>
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end space-y-2 lg:space-y-0 space-x-0 lg:space-x-2">
                    <x-btn-action type="submit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <x-btn-label>Search</x-btn-label>
                    </x-btn-action>
                </div>
            </div>
        </form>
    </div>
    <div class="rounded bg-white dark:bg-gray-800 dark:text-white p-4 w-full">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900 dark:text-white">
                Performa Delivery
            </h2>
            <div class="flex justify-start space-x-2">
                <x-btn-link :href="route('opr.dailyperformance.express.create')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <x-btn-label>Craete</x-btn-label>
                </x-btn-link>
                @can('opr dailyperformance summary')
                    <x-btn-link :href="route('opr.dailyperformance.summary.express.index')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                            </path>
                        </svg>
                        <x-btn-label>Summary</x-btn-label>
                    </x-btn-link>
                @endcan
                <x-btn-action onclick="downloadIt()" type="button" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <x-btn-label>Export</x-btn-label>
                </x-btn-action>
                <form id="exportReport" action="{{ route('opr.dailyperformance.summary.express.export') }}"
                    method="GET">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="thru" value="{{ request('thru') }}">
                    <input type="hidden" name="hub" value="{{ request('hub') }}">
                </form>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="divide-x">
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Date Inbound
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Closed At
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Zone
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Hub
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Total Ship COD
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Total Nominal COD
                        </th>
                        <th colspan="14" scope="col" class="px-6 py-3 text-center bg-gray-100 dark:bg-gray-600">
                            H 0
                        </th>
                        <th colspan="14" scope="col" class="px-6 py-3 text-center">
                            H+1
                        </th>
                        <th colspan="14" scope="col" class="px-6 py-3 text-center bg-gray-100 dark:bg-gray-600">
                            H+2
                        </th>

                    </tr>
                    <tr class="divide-x">
                        {{-- h0 --}}
                        <th scope="col" class="px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Sukses Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            WH1
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Hold WH
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Failed Delivery
                        </th>

                        {{-- h1 --}}
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            Sukses Return
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            WH1
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            %Hold WH
                        </th>
                        <th scope="col" class="bg-gray-100 dark:bg-gray-600 px-6 py-3 text-center">
                            %Failed Delivery
                        </th>

                        {{-- h2 --}}
                        <th scope="col" class="px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Sukses Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            WH1
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Hold WH
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($performances as $performance)
                        <tr
                            class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <a class="text-indigo-500 hover:underline focus:text-indigo-700"
                                    href="{{ route('opr.dailyperformance.express.edit', $performance->id) }}">
                                    {{ date('d/m/Y', strtotime($performance->inbound_date)) }}
                                </a>
                            </th>
                            <td class="px-6 py-4">
                                {{ $performance->closed ? 'H+' . $performance->closed : 'Open' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->zone }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->hub }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->total_shipment_cod }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->total_nominal_cod }}
                            </td>

                            {{-- h-0 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->unrunsheet_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->delivered_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->successreturn_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->undel_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->open_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->return_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->wh_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ floor((($performance->delivered_0 + $performance->successreturn_0) / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor(($performance->unrunsheet_0 / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor(($performance->return_0 / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor(($performance->wh_0 / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor((($performance->unrunsheet_0 + $performance->cr_0 + $performance->undel_0 + $performance->open_0 + $performance->return_0 + $performance->wh_0) / $performance->total_0) * 100) }}%
                            </td>


                            {{-- h-1 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->unrunsheet_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->delivered_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->successreturn_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->undel_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->open_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->return_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->wh_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor((($performance->delivered_1 + $performance->successreturn_1) / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor(($performance->unrunsheet_1 / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor(($performance->return_1 / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor(($performance->wh_1 / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor((($performance->unrunsheet_1 + $performance->cr_1 + $performance->undel_1 + $performance->open_1 + $performance->return_1 + $performance->wh_1) / $performance->total_1) * 100) . '%' : '' }}
                            </td>


                            {{-- h-2 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->unrunsheet_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->delivered_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->successreturn_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->undel_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->open_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->return_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->wh_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor((($performance->delivered_2 + $performance->successreturn_2) / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor(($performance->unrunsheet_2 / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor(($performance->return_2 / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor(($performance->wh_2 / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor((($performance->unrunsheet_2 + $performance->cr_2 + $performance->undel_2 + $performance->open_2 + $performance->return_2 + $performance->wh_2) / $performance->total_2) * 100) . '%' : '' }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="px-6 py-2">
            {{ $performances->links() }}
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
