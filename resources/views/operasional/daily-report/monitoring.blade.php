<x-sidebar-layout>

    @if (Session::has('green'))
        <div class="p-4 mb-3 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium">Berhasil !!! </span> {{ Session::get('green') }}
        </div>
    @elseif (Session::has('yellow'))
        <div class="p-4 mb-3 text-sm text-amber-700 bg-amber-100 rounded-lg dark:bg-amber-200 dark:text-amber-800"
            role="alert">
            <span class="font-medium">Perhaian !!! </span> {{ Session::get('yellow') }}
        </div>
    @endif
    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">

        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl">
                Filters
            </h2>
        </div>
        <form action="{{ route('opr.daily-report.dailyperformance.index') }}">
            <div class="grid lg:grid-cols-6 mb-3 space-y-2 lg:space-y-0 space-x-0 lg:space-x-2"">
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
    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl">
                Performa Delivery
            </h2>
            <div class="flex justify-start space-x-2">
                <x-btn-link :href="route('opr.daily-report.dailyperformance.index')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                        </path>
                    </svg>
                    <x-btn-label>Performa Delivery</x-btn-label>
                </x-btn-link>
                <x-btn-action onclick="downloadIt()" type="button" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <x-btn-label>Export</x-btn-label>
                </x-btn-action>
                <form id="exportReport" action="{{ route('opr.daily-report.dailyperformance.exportsum') }}"
                    method="GET">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="thru" value="{{ request('thru') }}">
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
                            Zone
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Total Ship COD
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Total Nominal COD
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center bg-gray-100">
                            H 0
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+1
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center bg-gray-100">
                            H+2
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+3
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center bg-gray-100">
                            H+4
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+5
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center bg-gray-100">
                            H+6
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+7
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
                            %Sukses Del
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Failed Delivery
                        </th>

                        {{-- h1 --}}
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
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
                            %Sukses Del
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                        {{-- h3 --}}
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                        {{-- h4 --}}
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
                            %Sukses Del
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                        {{-- h5 --}}
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                        {{-- h6 --}}
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
                            %Sukses Del
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                        {{-- h7 --}}
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            TTL Cnote
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Runsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Delivered
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            CR
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Undel
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Un Status
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Sukses Del
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Unrunsheet
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Return
                        </th>
                        <th scope="col" class="bg-gray-100 px-6 py-3 text-center">
                            %Failed Delivery
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($performances as $performance)
                        <tr
                            class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white dark:text-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <th class="px-6 py-4">
                                {{ date('d/m/Y', strtotime($performance->inbound_date)) }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $performance->zone }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $performance->total_shipment_cod }}
                            </td>
                            <td class="px-6 py-4 text-end">
                                {{ $performance->total_nominal_cod }}
                            </td>

                            {{-- h-0 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_0 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ floor(($performance->d_0 / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor(($performance->ur_0 / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor(($performance->r_0 / $performance->total_0) * 100) }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ floor((($performance->total_0 - $performance->d_0) / $performance->total_0) * 100) }}%
                            </td>


                            {{-- h-1 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_1 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor(($performance->d_1 / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor(($performance->ur_1 / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor(($performance->r_1 / $performance->total_1) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_1 ? floor((($performance->total_1 - $performance->d_1) / $performance->total_1) * 100) . '%' : '' }}
                            </td>


                            {{-- h-2 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_2 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor(($performance->d_2 / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor(($performance->ur_2 / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor(($performance->r_2 / $performance->total_2) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_2 ? floor((($performance->total_2 - $performance->d_2) / $performance->total_2) * 100) . '%' : '' }}
                            </td>

                            {{-- h-3 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_3 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_3 ? floor(($performance->d_3 / $performance->total_3) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_3 ? floor(($performance->ur_3 / $performance->total_3) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_3 ? floor(($performance->r_3 / $performance->total_3) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_3 ? floor((($performance->total_3 - $performance->d_3) / $performance->total_3) * 100) . '%' : '' }}
                            </td>



                            {{-- h-4 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_4 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_4 ? floor(($performance->d_4 / $performance->total_4) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_4 ? floor(($performance->ur_4 / $performance->total_4) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_4 ? floor(($performance->r_4 / $performance->total_4) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_4 ? floor((($performance->total_4 - $performance->d_4) / $performance->total_4) * 100) . '%' : '' }}
                            </td>


                            {{-- h-5 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_5 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_5 ? floor(($performance->d_5 / $performance->total_5) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_5 ? floor(($performance->ur_5 / $performance->total_5) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_5 ? floor(($performance->r_5 / $performance->total_5) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_5 ? floor((($performance->total_5 - $performance->d_5) / $performance->total_5) * 100) . '%' : '' }}
                            </td>


                            {{-- h-6 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_6 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_6 ? floor(($performance->d_6 / $performance->total_6) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_6 ? floor(($performance->ur_6 / $performance->total_6) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_6 ? floor(($performance->r_6 / $performance->total_6) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_6 ? floor((($performance->total_6 - $performance->d_6) / $performance->total_6) * 100) . '%' : '' }}
                            </td>

                            {{-- h-7 --}}
                            <td class="px-6 py-4">
                                {{ $performance->total_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->ur_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->d_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->cr_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->u_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->o_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->r_7 }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_7 ? floor(($performance->d_7 / $performance->total_7) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_7 ? floor(($performance->ur_7 / $performance->total_7) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_7 ? floor(($performance->r_7 / $performance->total_7) * 100) . '%' : '' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->date_7 ? floor((($performance->total_7 - $performance->d_7) / $performance->total_7) * 100) . '%' : '' }}
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
