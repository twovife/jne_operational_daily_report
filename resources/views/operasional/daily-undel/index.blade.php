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
                            @if (Auth::user()->roles->where('name', 'opr pod')->first())
                                <option value="{{ Auth::user()->employee->hub }}">{{ Auth::user()->employee->hub }}
                                </option>
                            @else
                                <option value="">Choose a HUB</option>
                                @foreach ($hubs as $hub)
                                    <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                                @endforeach
                            @endif
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
                <a role="button" href="{{ route('opr.daily-report.undel.create') }}"
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


        <div class="overflow-x-auto relative shadow">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="whitespace-nowrap">
                        <th scope="col" class="py-3 px-6">
                            Date
                        </th>
                        <th scope="col" class="py-3 px-6">
                            No. AWB
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Origin
                        </th>
                        <th scope="col" class="py-3 px-6">
                            HUB
                        </th>
                        <th scope="col" class="py-3 px-6 ">
                            Courier / Shipper
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Cnee
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Cnee Addrs
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Cnee Phone
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Goods Desc
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Code
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Undel Desc
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Date Inb
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Cust id
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Cust Name
                        </th>
                        <th scope="col" class="py-3 px-6">
                            SLA HOLD
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Return Date
                        </th>
                        <th scope="col" class="py-3 px-6 bg-indigo-200">
                            Last Action Date
                        </th>
                        <th scope="col" class="py-3 px-6 bg-indigo-200">
                            Follow Up
                        </th>
                        <th scope="col" class="py-3 px-6 bg-indigo-200">
                            Last Action
                        </th>
                        <th scope="col" class="py-3 px-6 bg-indigo-200">
                            Note
                        </th>
                        <th scope="col" class="py-3 px-6 bg-indigo-200">
                            Status
                        </th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($performances as $performance)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6 whitespace-nowrap">
                                <a href="{{ route('opr.daily-report.undel.edit', $performance->id) }}"
                                    class="text-indigo-700 hover:text-indigo-900 focus:text-indigo-900 hover:font-semibold focus:font-semibold">
                                    {{ $performance->date }}
                                </a>
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->no_awb }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->origin }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->hub }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->shipper_name->nama }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->consignee }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->consignee_addr }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->phone }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->goods_desc }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->undel_code }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->undel_desc }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->date_inbound }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $performance->customer_account->nomor_account }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->customer_account->customer_name }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->sla }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->date_return }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->date_return }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->date_return }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->date_return }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->date_return }}
                            </td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                {{ $performance->status == 1 ? 'CLOSED' : 'OPEN' }}
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
