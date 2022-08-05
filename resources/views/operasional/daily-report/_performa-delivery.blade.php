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
    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Filters
            </h2>
        </div>
        <form action="{{ route('opr.daily-report.dailyperformance.index') }}">
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
                @if (Auth::user()->roles->where('name', '!=', 'opr pod')->first())
                    <div>
                        <label for="hub"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Select an
                            option</label>
                        <select id="hub" name="hub"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

                            @if (request('hub'))
                                <option value="{{ request('hub') }}">{{ request('hub') }}</option>
                            @endif
                            <option value="">Choose a HUB</option>
                            <option value="NGADILUWIH">NGADILUWIH</option>
                            <option value="PARE">PARE</option>
                            <option value="BANJARAN">BANJARAN</option>
                            <option value="BANYAKAN">BANYAKAN</option>
                        </select>
                    </div>
                @endif
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
                <a role="button" href="{{ route('opr.daily-report.dailyperformance.create') }}"
                    class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    Create
                </a>
                <form action="{{ route('opr.daily-report.dailyperformance.export') }}" method="GET">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="thru" value="{{ request('thru') }}">
                    <input type="hidden" name="hub" value="{{ request('hub') }}">
                    <button type="submit"
                        class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:focus:ring-yellow-900">
                        Export</button>

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
                            Hub
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Total Ship COD
                        </th>
                        <th rowspan="2" scope="col" class="px-6 py-3 text-center">
                            Total Nominal COD
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H 0
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+1
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+2
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+3
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+4
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+5
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+6
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+7
                        </th>
                        <th colspan="11" scope="col" class="px-6 py-3 text-center">
                            H+8 Above
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
                        {{-- h7+ --}}

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
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($performances as $performance)
                        <tr
                            class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                <a class="text-indigo-500 hover:underline focus:text-indigo-700"
                                    href="{{ route('opr.daily-report.dailyperformance.edit', $performance->id) }}">
                                    {{ date('d/m/Y', strtotime($performance->inbound_date)) }}
                                </a>
                            </th>
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
                                {{ $performance->OprDailyPerformanceDetail[0]->total_cnote }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->un_runsheet }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->delivered }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->cr }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->undel }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->un_status }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->return }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->sukses_delivery_percentage }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->un_runsheet_percentage }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->return_percentage }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[0]->failed_delivery }}%
                            </td>

                            {{-- h1 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[1]->failed_delivery ?? 0 }}%
                            </td>

                            {{-- h2 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[2]->failed_delivery ?? 0 }}%
                            </td>
                            {{-- h3 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[3]->failed_delivery ?? 0 }}%
                            </td>
                            {{-- h4 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[4]->failed_delivery ?? 0 }}%
                            </td>
                            {{-- h5 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[5]->failed_delivery ?? 0 }}%
                            </td>
                            {{-- h6 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[6]->failed_delivery ?? 0 }}%
                            </td>
                            {{-- h7 --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[7]->failed_delivery ?? 0 }}%
                            </td>
                            {{-- h8 above --}}
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->total_cnote ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->un_runsheet ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->delivered ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->cr ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->undel ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->un_status ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->return ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->sukses_delivery_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->un_runsheet_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->return_percentage ?? 0 }}%
                            </td>
                            <td class="px-6 py-4">
                                {{ $performance->OprDailyPerformanceDetail[8]->failed_delivery ?? 0 }}%
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
</x-sidebar-layout>
