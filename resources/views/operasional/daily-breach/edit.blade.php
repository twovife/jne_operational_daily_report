<x-sidebar-layout>
    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Input Data Undel
            </h2>
            <div class="flex justify-start ml-auto gap-2">
                @can('opr undel delete')
                    <x-btn-action data-modal-toggle="delete-modal-1" type="button" :btntype="'danger'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        <x-btn-label>Delete</x-btn-label>
                    </x-btn-action>
                @endcan
                <x-btn-link :href="route('opr.breach.index')" :btntype="'primary'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <x-btn-label>Back</x-btn-label>
                </x-btn-link>
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

    @if (session()->has('green'))
        <x-alert-message :message="session('green')" :color="'green'"></x-alert-message>
    @endif
    @if (session()->has('yellow'))
        <x-alert-message :message="session('yellow')" :color="'yellow'"></x-alert-message>
    @endif


    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <form action="{{ route('opr.breach.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 lg:grid-cols-3">
                <div>
                    <label for="date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Date</label>
                    <input type="date" id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required="" value="{{ $data->date }}">
                </div>
                <div>
                    <label for="hub"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">HUB</label>
                    <select id="hub" name="hub" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="{{ $data->arrivebreach->hub }}">{{ $data->arrivebreach->hub }}</option>
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="no_awb"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">No. AWB</label>
                    <input readonly type="text" id="no_awb" name="no_awb"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="35xxxxxxxxxxxx01" value="{{ $data->arrivebreach->no_awb }}" required="">
                </div>
                <div>
                    <label for="date_inbound"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Inbound
                        Date</label>
                    <input type="date" id="date_inbound" name="date_inbound"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ date('Y-m-d') }}" value="{{ $data->arrivebreach->date_inbound }}" required="">
                </div>
                <div>
                    <label for="origin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Origin</label>
                    <input type="text" id="origin" name="origin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Origin Code" required="" value="{{ $data->arrivebreach->origin }}">
                </div>
                <div>
                    <label for="goods_desc"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Goods
                        Desc</label>
                    <input type="text" id="goods_desc" name="goods_desc"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Goods Description" value="{{ $data->arrivebreach->goods_desc }}" required="">
                </div>

                <div>
                    <label for="status"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Status</label>
                    <input type="text" id="status" name="status"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Status Code" required="" value="{{ $data->status }}">
                </div>
                <div>
                    <label for="reason"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Reason</label>
                    <input type="text" id="reason" name="reason"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Reason" required="" value="{{ $data->reason }}">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                        for="file_input">Upload file</label>
                    <input
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" name="file_input" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG
                        (MAX. 1MB).</p>
                </div>
                <div>
                    <label for="opr_customer_account_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Customer</label>
                    <input disabled type="text" id="opr_customer_account_id" name="opr_customer_account_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="opr_customer_account_id"
                        value="{{ $data->arrivebreach->customer->nomor_account }} - {{ $data->arrivebreach->customer->customer_name }}">
                </div>

            </div>
            @can('opr undel create')
                <x-btn-action type="submit" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <x-btn-label>Update</x-btn-label>
                </x-btn-action>
            @endcan
        </form>
    </div>

    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div>
            <h2 class="text-lg font-semibold mb-3">Dokumentasi Barang</h2>
            <div class="grid gap-6 mb-6 lg:grid-cols-4">
                <div class="border shadow-sm">
                    <img src="{{ asset('storage/' . $data->img_name) }}" alt="" srcset=""
                        class="w-full">
                </div>
            </div>
        </div>
    </div>



    <div id="delete-modal-1" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    data-modal-toggle="delete-modal-1">
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
                        <form action="{{ route('opr.breach.arrivaldestroy', $data->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-toggle="delete-modal-1" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-sidebar-layout>
