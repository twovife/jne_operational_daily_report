<x-sidebar-layout>
    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Input Data Performa Delivery
            </h2>
            <div class="flex justify-start">
                <a role="button" href="{{ route('opr.daily-report.dailyperformance.index') }}"
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

    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="rounded bg-white px-4 py-3 w-full mb-3">
            <div class="grid gap-6 mb-6 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <label for="inbound_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Inbound
                        Date</label>
                    <input type="date" id="inbound_date" name="inbound_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="John" value="{{ $data->inbound_date }}" required="">
                </div>
                <div>
                    <label for="zone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Select
                        Zone</label>
                    <select id="zone" name="zone" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="{{ $data->zone }}" selected>{{ $data->zone }}</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                    </select>
                </div>
                <div>
                    <label for="hub"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Select
                        Hub</label>
                    <select id="hub" name="hub" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="{{ $data->hub }}" selected>{{ $data->hub }}</option>
                        <option value="NGADILUWIH">NGADILUWIH</option>
                        <option value="PARE">PARE</option>
                        <option value="BANJARAN">BANJARAN</option>
                        <option value="BANYAKAN">BANYAKAN</option>
                    </select>
                </div>
                <div>
                    <label for="total_shipment_cod"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Total Shipment
                        COD</label>
                    <input value="{{ $data->total_shipment_cod }}" type="number" id="total_shipment_cod"
                        name="total_shipment_cod"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="total_nominal_cod"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Total Nominal
                        COD
                        URL</label>
                    <input value="{{ $data->total_nominal_cod }}" type="number" id="total_nominal_cod"
                        name="total_nominal_cod"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
            </div>
            <div class="flex justify-between items-center">
                <button type="submit"
                    class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Update</button>
                <button type="button" data-modal-toggle="popup-modal"
                    class="flex items-center text-white bg-rose-700 hover:bg-rose-800 focus:ring focus:outline-none focus:ring-rose-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2 text-center dark:bg-rose-600 dark:hover:bg-rose-700 dark:focus:ring-rose-800">delete</button>
            </div>
        </div>
    </form>


    {{-- 0 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="0">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+0
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_0 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_0" name="total_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_0 }}" data-name="sumit" data-id="ur" type="number" id="ur_0"
                        name="ur_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_0 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_0" name="d_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_0 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_0" name="cr_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_0 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_0" name="u_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_0 }}" data-name="sumit" data-id="open" type="number"
                        id="o_0" name="o_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_0 }}" data-name="sumit" data-id="return" type="number"
                        id="r_0" name="r_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_0 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 1 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="1">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+1
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_1 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_1" name="total_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_1 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_1 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_1" name="d_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_1 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_1" name="cr_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_1 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_1" name="u_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_1 }}" data-name="sumit" data-id="open" type="number"
                        id="o_1" name="o_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_1 }}" data-name="sumit" data-id="return" type="number"
                        id="r_1" name="r_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_1 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 2 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="2">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+2
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_2 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_2" name="total_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_2 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_2 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_2" name="d_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_2 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_2" name="cr_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_2 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_2" name="u_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_2 }}" data-name="sumit" data-id="open" type="number"
                        id="o_2" name="o_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_2 }}" data-name="sumit" data-id="return" type="number"
                        id="r_2" name="r_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_2 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 3 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="3">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+3
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_3"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_3 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_3" name="total_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_3 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_3"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_3 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_3" name="d_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_3"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_3 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_3" name="cr_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_3"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_3 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_3" name="u_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_3" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_3 }}" data-name="sumit" data-id="open" type="number"
                        id="o_3" name="o_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_3"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_3 }}" data-name="sumit" data-id="return" type="number"
                        id="r_3" name="r_3"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_3 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 4 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="4">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+4
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_4"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_4 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_4" name="total_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_4 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_4"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_4 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_4" name="d_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_4"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_4 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_4" name="cr_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_4"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_4 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_4" name="u_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_4" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_4 }}" data-name="sumit" data-id="open" type="number"
                        id="o_4" name="o_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_4"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_4 }}" data-name="sumit" data-id="return" type="number"
                        id="r_4" name="r_4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_4 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 5 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="5">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+5
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_5"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_5 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_5" name="total_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_5 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_5"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_5 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_5" name="d_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_5"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_5 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_5" name="cr_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_5"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_5 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_5" name="u_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_5" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_5 }}" data-name="sumit" data-id="open" type="number"
                        id="o_5" name="o_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_5"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_5 }}" data-name="sumit" data-id="return" type="number"
                        id="r_5" name="r_5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_5 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 6 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="6">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+6
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_6"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_6 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_6" name="total_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_6 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_6"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_6 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_6" name="d_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_6"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_6 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_6" name="cr_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_6"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_6 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_6" name="u_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_6" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_6 }}" data-name="sumit" data-id="open" type="number"
                        id="o_6" name="o_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_6"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_6 }}" data-name="sumit" data-id="return" type="number"
                        id="r_6" name="r_6"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_6 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>

    {{-- 7 --}}
    <form action="{{ route('opr.daily-report.dailyperformance.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="7">
        <div onkeyup="thisIsChange(this)" class="rounded bg-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl text-gray-900 mb-3">
                H+7
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-8 items-end">
                <div>
                    <label for="total_7"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_7 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_7" name="total_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="ur_7" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        received</label>
                    <input value="{{ $data->ur_7 }}" data-name="sumit" data-id="ur" type="number" x
                        id="ur_1" name="ur_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="d_7"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->d_7 }}" data-name="sumit" data-id="delivered"
                        type="number" id="d_7" name="d_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="cr_7"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">CR</label>
                    <input value="{{ $data->cr_7 }}" data-name="sumit" data-id="cr" type="number"
                        id="cr_7" name="cr_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="u_7"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->u_7 }}" data-name="sumit" data-id="undel" type="number"
                        id="u_7" name="u_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="o_7" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->o_7 }}" data-name="sumit" data-id="open" type="number"
                        id="o_7" name="o_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="r_7"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->r_7 }}" data-name="sumit" data-id="return" type="number"
                        id="r_7" name="r_7"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    @can('opr daily edit')
                        <button type="submit"
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @else
                        <button type="submit" {{ $data->date_7 ? 'disabled' : '' }}
                            class="flex items-center text-white bg-indigo-700 hover:bg-indigo-800 focus:ring focus:outline-none focus:ring-indigo-200 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-3 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800 disabled:cursor-not-allowed">Update</button>
                    @endcan

                </div>
            </div>
        </div>
    </form>



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
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to
                        delete this data?</h3>
                    <div class="flex justify-center items-center">
                        <form action="{{ route('opr.daily-report.dailyperformance.destroy', $data->id) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-toggle="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-slot name="javascript">
        <script>
            function thisIsChange(event) {
                const inputFiller = event.querySelectorAll('[data-name="sumit"]')

                inputFiller.forEach(element => {
                    element.addEventListener('change', function(e) {
                        event.querySelector('[data-id="delivered"]').value = sumAll()
                        // alert('asd')
                    })
                });

                const sumAll = () => {
                    const total_cnote = event.querySelector('[data-id="total_cnote"]').value
                    const un_runsheet = event.querySelector('[data-id="ur"]').value
                    const cr = event.querySelector('[data-id="cr"]').value
                    const undel = event.querySelector('[data-id="undel"]').value
                    const un_status = event.querySelector('[data-id="open"]').value
                    const rt = event.querySelector('[data-id="return"]').value

                    return total_cnote - un_runsheet - cr - undel - un_status - rt
                }
            }
        </script>
    </x-slot>
</x-sidebar-layout>
