<x-sidebar-layout>
    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center">
            <h2 class="text-xl">
                Input Data Performa Delivery
            </h2>
            <div class="flex justify-start">
                <x-btn-link :href="route('opr.dailyperformance.express.index')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18">
                        </path>
                    </svg>
                    <x-btn-label>Back</x-btn-label>
                </x-btn-link>
            </div>
        </div>
    </div>

    <x-error-input-alert :status="session('errors')"></x-error-input-alert>
    @if (session()->has('green'))
        <x-alert-message :message="session('green')" :color="'green'"></x-alert-message>
    @endif
    @if (session()->has('yellow'))
        <x-alert-message :message="session('yellow')" :color="'yellow'"></x-alert-message>
    @endif
    @if (session()->has('red'))
        <x-alert-message :message="session('red')" :color="'red'"></x-alert-message>
    @endif


    <form action="{{ route('opr.dailyperformance.ctc.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
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
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                        @endforeach
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
            @can('opr dailyperformance delete')
                <div class="flex justify-end items-center gap-2">
                    <x-btn-action type="submit" :btntype="'success'">
                        <svg class="w-5 h-" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        <x-btn-label>Save</x-btn-label>
                    </x-btn-action>
                    <x-btn-action type="button" :btntype="'danger'" data-modal-toggle="popup-modal">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        <x-btn-label>Delete</x-btn-label>
                    </x-btn-action>
                </div>
            @endcan
        </div>
    </form>


    {{-- 0 --}}
    <form action="{{ route('opr.dailyperformance.ctc.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="0">
        <div onkeyup="thisIsChange(this)"
            class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl mb-3">
                H+0
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-10 items-end">
                <div>
                    <label for="total_0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        Cnote</label>
                    <input value="{{ $data->total_0 }}" data-name="sumit" data-id="total_cnote" type="number"
                        id="total_0" name="total_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="unrunsheet_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un Runsheet</label>
                    <input value="{{ $data->unrunsheet_0 }}" data-name="sumit" data-id="ur" type="number"
                        id="unrunsheet_0" name="unrunsheet_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="delivered_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->delivered_0 }}" data-name="sumit" data-id="delivered"
                        type="number" id="delivered_0" name="delivered_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="successreturn_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sukses Return</label>
                    <input value="{{ $data->successreturn_0 }}" data-name="sumit" data-id="successreturn"
                        type="number" id="successreturn_0" name="successreturn_0"
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
                    <label for="undel_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->undel_0 }}" data-name="sumit" data-id="undel" type="number"
                        id="undel_0" name="undel_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="open_0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->open_0 }}" data-name="sumit" data-id="open" type="number"
                        id="open_0" name="open_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="return_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->return_0 }}" data-name="sumit" data-id="return" type="number"
                        id="return_0" name="return_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="wh_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">WH1</label>
                    <input value="{{ $data->wh_0 }}" data-name="sumit" data-id="wh" type="number"
                        id="wh_0" name="wh_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>


                <div>
                    @can('opr dailyperformance update')
                        <x-btn-action type="submit" :btntype="'success'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <x-btn-label>{{ $data->date_0 ? 'Update' : 'Add' }} </x-btn-label>
                        </x-btn-action>
                    @else
                        @if (Auth::user()->roles->where('name', 'opr pod')->first())
                            <x-btn-action type="submit" :btntype="'success'" :disabled="$data->date_0 ? true : false">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <x-btn-label>Add</x-btn-label>
                            </x-btn-action>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </form>

    {{-- 1 --}}
    <form action="{{ route('opr.dailyperformance.ctc.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="1">
        <div onkeyup="thisIsChange(this)"
            class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl mb-3">
                H+1
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-10 items-end">
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
                    <label for="unrunsheet_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un Runsheet</label>
                    <input value="{{ $data->unrunsheet_1 }}" data-name="sumit" data-id="ur" type="number" x
                        id="unrunsheet_1" name="unrunsheet_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="delivered_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->delivered_1 }}" data-name="sumit" data-id="delivered"
                        type="number" id="delivered_1" name="delivered_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="successreturn_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sukses Return</label>
                    <input value="{{ $data->successreturn_1 }}" data-name="sumit" data-id="successreturn"
                        type="number" id="successreturn_1" name="successreturn_1"
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
                    <label for="undel_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->undel_1 }}" data-name="sumit" data-id="undel" type="number"
                        id="undel_1" name="undel_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="open_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->open_1 }}" data-name="sumit" data-id="open" type="number"
                        id="open_1" name="open_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="return_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->return_1 }}" data-name="sumit" data-id="return" type="number"
                        id="return_1" name="return_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="wh_1"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">WH1</label>
                    <input value="{{ $data->wh_1 }}" data-name="sumit" data-id="wh" type="number"
                        id="wh_1" name="wh_1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div>
                    @can('opr dailyperformance update')
                        <x-btn-action type="submit" :btntype="'success'">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <x-btn-label>{{ $data->date_1 ? 'Update' : 'Add' }} </x-btn-label>
                        </x-btn-action>
                    @else
                        @if (Auth::user()->roles->where('name', 'opr pod')->first())
                            <x-btn-action type="submit" :btntype="'success'" :disabled="$data->date_1 ? true : false">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <x-btn-label>Add</x-btn-label>
                            </x-btn-action>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </form>

    {{-- 2 --}}
    <form action="{{ route('opr.dailyperformance.ctc.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="d_day" value="2">
        <div onkeyup="thisIsChange(this)"
            class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
            <h2 class="text-xl mb-3">
                > H+1
            </h2>
            <div class="grid gap-6 mb-6 grid-cols-4 md:grid-cols-10 items-end">
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
                    <label for="unrunsheet_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un Runsheet</label>
                    <input value="{{ $data->unrunsheet_2 }}" data-name="sumit" data-id="ur" type="number" x
                        id="unrunsheet_1" name="unrunsheet_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="delivered_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Delivered</label>
                    <input readonly value="{{ $data->delivered_2 }}" data-name="sumit" data-id="delivered"
                        type="number" id="delivered_2" name="delivered_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="successreturn_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Sukses Return</label>
                    <input value="{{ $data->successreturn_2 }}" data-name="sumit" data-id="successreturn"
                        type="number" id="successreturn_2" name="successreturn_2"
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
                    <label for="undel_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Undel</label>
                    <input value="{{ $data->undel_2 }}" data-name="sumit" data-id="undel" type="number"
                        id="undel_2" name="undel_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="open_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Un
                        Status</label>
                    <input value="{{ $data->open_2 }}" data-name="sumit" data-id="open" type="number"
                        id="open_2" name="open_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>
                <div>
                    <label for="return_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Return</label>
                    <input value="{{ $data->return_2 }}" data-name="sumit" data-id="return" type="number"
                        id="return_2" name="return_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div>
                    <label for="wh_2"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">WH1</label>
                    <input value="{{ $data->wh_2 }}" data-name="sumit" data-id="wh" type="number"
                        id="wh_2" name="wh_2"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required>
                </div>

                <div class="flex gap-2">
                    <x-btn-action type="submit" :btntype="'success'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <x-btn-label>{{ $data->date_2 ? 'Update' : 'Add' }} </x-btn-label>
                    </x-btn-action>
                </div>
            </div>
        </div>
    </form>


    <div id="popup-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white dark:bg-gray-800 dark:text-white rounded-lg shadow">
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
                        <form action="{{ route('opr.dailyperformance.express.destroy', $data->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-toggle="popup-modal" type="button"
                            class="text-gray-500 bg-white dark:bg-gray-800 dark:text-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
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
                    const wh = event.querySelector('[data-id="wh"]').value
                    const sr = event.querySelector('[data-id="successreturn"]').value

                    return total_cnote - un_runsheet - cr - undel - un_status - rt - wh - sr
                }
            }
        </script>
    </x-slot>
</x-sidebar-layout>
