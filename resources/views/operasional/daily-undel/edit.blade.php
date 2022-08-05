<x-sidebar-layout>
    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl font-semibold text-gray-900">
                Edit Data Un-Delivery
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


    <form action="{{ route('opr.daily-report.undel.update', $data->id) }}" method="POST">
        @can('opr undel update')
            @csrf
            @method('PUT')
        @endcan
        <div class="rounded bg-white px-4 py-3 w-full mb-3">
            <div class="grid gap-6 mb-6 lg:grid-cols-6">
                <div>
                    <label for="date"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Date</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=date' }}
                        type="date" id="date"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->date }}" required="">
                </div>
                <div>
                    <label for="origin"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Origin</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=origin' }}
                        type="text" id="origin"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->origin }}" required="">
                </div>
                <div>
                    <label for="hub"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">HUB</label>
                    <select required="" {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=hub' }}
                        id="hub" required=""
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if ($data->hub)
                            <option selected value="{{ $data->hub }}">
                                {{ $data->hub }}
                            </option>
                        @endif
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->id }}">
                                {{ $hub->hub }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="lg:col-span-2">
                    <label for="shipper"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Courier</label>
                    <select required="" {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=shipper' }}
                        id="shipper" required=""
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if ($data->shipper_name)
                            <option selected value="{{ $data->shipper_name->id }}">
                                {{ $data->shipper_name->nama }} - {{ $data->shipper_name->jabatan }} |
                                {{ $data->shipper_name->divisi }}
                            </option>
                        @endif
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->nama }} - {{ $employee->jabatan }} | {{ $employee->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div></div>
                <div>
                    <label for="no_awb"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">No
                        AWB</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=no_awb' }}
                        type="text" id="no_awb"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->no_awb }}" required="">
                </div>
                <div>
                    <label for="consignee"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Consignee</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=consignee' }}
                        type="text" id="consignee"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->consignee }}" required="">
                </div>
                <div class="lg:col-span-2">
                    <label for="consignee_addr"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cnee
                        Addrs</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=consignee_addr' }}
                        type="text" id="consignee_addr"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->consignee_addr }}" required="">
                </div>

                <div>
                    <label for="phone"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cnee
                        Telp</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=phone' }}
                        type="text" id="phone"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->phone }}" required="">
                </div>
                <div>
                    <label for="goods_desc"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Goods
                        Desc</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=goods_desc' }}
                        type="text" id="goods_desc"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->goods_desc }}" required="">
                </div>

                <div>
                    <label for="undel_code"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Undel
                        Status</label>
                    <select id="undel_code" required="" {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=undel_code' }}
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected value="{{ $data->undel_code }}">{{ $data->undel_code }}</option>
                        @for ($x = 1; $x <= 14; $x++)
                            @if ($x < 10)
                                <option value="U0{{ $x }}">U0{{ $x }}</option>
                            @else
                                <option value="U{{ $x }}">U{{ $x }}</option>
                            @endif
                        @endfor
                        @for ($x = 21; $x <= 25; $x++)
                            <option value="U{{ $x }}">U{{ $x }}</option>
                        @endfor
                    </select>
                </div>
                <div class="lg:col-span-2">
                    <label for="undel_desc"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Undel
                        desc</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=undel_desc' }}
                        type="text" id="undel_desc"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Deskripsi Undel" value="{{ $data->undel_desc }}" required="">
                </div>
                <div>
                    <label for="date_inbound"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Inbound
                        Date</label>
                    <input {{ $data->status == 1 ? 'disabled' : '' }}
                        {{ Auth::user()->roles->where('name', 'opr pod')->first()? 'disabled': 'name=date_inbound' }}
                        type="date" id="date_inbound"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->date_inbound }}" required="">
                </div>
                <div></div>
                <div></div>
                <div class="lg:col-span-2">
                    <label for="opr_customer_account_id"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Customer
                        Name</label>

                    <input disabled type="hidden" type="opr_customer_account_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->opr_customer_account_id }}">
                    <input disabled type="opr_customer_account_id" id="opr_customer_account_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:bg-gray-200"
                        placeholder="John"
                        value="{{ $data->customer_account->nomor_account }} - {{ $data->customer_account->customer_name }}">
                </div>
                <div>
                    <label for="sla"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">SLA</label>
                    <input disabled type="sla" id="sla"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:bg-gray-200"
                        placeholder="John" value="{{ $data->sla }}">
                </div>

                <div>
                    <label for="date_return"
                        class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return
                        Date</label>
                    <input disabled type="date" id="date_return"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 disabled:bg-gray-200"
                        placeholder="John" value="{{ $data->date_return }}">
                </div>
            </div>
            @if ($data->status != 1)
                @can('opr undel update')
                    <div class="flex justify-end items-center">
                        <button type="submit" href="{{ route('opr.daily-report.undel.index') }}"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                            Update
                        </button>
                    </div>
                @endcan
            @endif

        </div>
    </form>
    @if ($data->status != 1)
        <form action="{{ route('opr.daily-report.undel.action', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="rounded bg-white px-4 py-3 w-full mb-3">
                <h1 class="font-semibold text-xl mb-3">Last Action</h1>
                <div class="grid gap-6 mb-6 lg:grid-cols-6">
                    <div>
                        <label for="action_date"
                            class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Action
                            Date</label>
                        <input type="date" id="action_date" name="action_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="{{ date('Y-m-d') }}" required="">
                    </div>
                    <div>
                        <label for="last_action"
                            class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last
                            Action</label>
                        <input type="text" id="last_action" name="last_action"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Last Action" required="">
                    </div>
                    <div>
                        <label for="follow_up"
                            class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow
                            Up</label>
                        <input type="text" id="follow_up" name="follow_up"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="follow-up to customer" required="">
                    </div>
                    <div class="lg:col-span-2">
                        <label for="description"
                            class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                        <input type="text" id="description" name="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="input note or AWB RT" required="">
                    </div>

                    <div>
                        <label for="data_status"
                            class="block required mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Status</label>
                        <select required="" id="data_status" name="data_status" required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="1">Open</option>
                            <option value="2">Closed</option>
                            <option value="3">Breach</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end items-center">
                    <button type="submit" href="{{ route('opr.daily-report.undel.index') }}"
                        class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                        Add
                    </button>
                </div>
            </div>
        </form>
    @endif


    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <h2 class="text-xl font-semibold mb-3">Action History</h2>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            date
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Last Action
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Follow Up
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Description
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Created At
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->actions as $aksi)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $aksi->action_date }}
                            </th>
                            <td class="py-4 px-6">
                                {{ $aksi->last_action }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $aksi->follow_up }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $aksi->description }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $aksi->created_at }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if ($data->breach)
        <div class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl font-semibold mb-3">Breach</h2>

            <div class="grid gap-6 mb-6 lg:grid-cols-6">
                <div>
                    <label for="date_breach"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Breach Date</label>
                    <input disabled type="text" id="date_breach"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->breach->date }}">
                </div>
                <div>
                    <label for="breach_status"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Breach
                        Status</label>
                    <input disabled type="text" id="breach_status"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->breach->status }}">
                </div>
                <div class="col-span-4">
                    <label for="breach_reason"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Breach
                        reason</label>
                    <input disabled type="text" id="breach_reason"
                        class="disabled:bg-gray-200 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" value="{{ $data->breach->reason }}">
                </div>
            </div>

            <div>
                <h2 class="text-lg font-semibold mb-3">Dokumentasi Barang</h2>
                <div class="grid gap-6 mb-6 lg:grid-cols-4">
                    <div class="border shadow-sm">
                        <img src="{{ asset('storage/' . $data->breach->img_name) }}" alt="" srcset=""
                            class="w-full">
                    </div>
                </div>
            </div>

        </div>
    @endif



</x-sidebar-layout>
