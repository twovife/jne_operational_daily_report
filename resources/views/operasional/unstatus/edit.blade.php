<x-sidebar-layout>

    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
        <div class="flex justify-start items-center mb-3 gap-4">
            <h2 class="text-xl">
                Input Data Undel
            </h2>
            <div class="flex justify-start ml-auto gap-2">
                <x-btn-action onclick="craeteModal()" type="button" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <x-btn-label>Add</x-btn-label>
                </x-btn-action>
                <x-btn-action data-modal-toggle="delete-modal-1" type="button" :btntype="'danger'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    <x-btn-label>Delete</x-btn-label>
                </x-btn-action>
                <x-btn-link :href="route('opr.openstatus.unstatus.index')" :btntype="'primary'">
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
        <form action="{{ route('opr.openstatus.unstatus.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid gap-6 mb-6 md:grid-cols-6">
                <div>
                    <label for="date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Date</label>
                    <input type="date" id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="John" required="" value="{{ $data->date }}">
                </div>
                <div>
                    <label for="hub"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">HUB</label>
                    <select id="hub" name="hub" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="{{ $data->hub }}">{{ $data->hub }}</option>
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
                <div>
                    <label for="ttl_runsheet"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        AWB Runsheet</label>
                    <input type="number" id="ttl_runsheet" name="ttl_runsheet"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="" value="{{ $data->ttl_runsheet }}">
                </div>
            </div>
            @can('opr unstatus update')
                <div class="flex justify-end items-center">
                    <x-btn-action type="submit" id="submit" :btntype="'success'">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        <x-btn-label>Update</x-btn-label>
                    </x-btn-action>
                </div>
            @endcan
        </form>
    </div>
    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">

        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="text-center">
                        <th scope="col" class="py-3 px-6">
                            Edit
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Date
                        </th>
                        <th scope="col" class="py-3 px-6">
                            HUB
                        </th>
                        <th scope="col" class="py-3 px-6">
                            No. AWB
                        </th>
                        <th scope="col" class="py-3 px-6">
                            No. Runsheet
                        </th>
                        <th scope="col" class="py-3 px-6">
                            User Courier
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Remark
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Remark Status
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Follow Up
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Closed Date
                        </th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($data->details as $data_detail)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6">
                                <div class="flex justify-center items-center gap-4">
                                    <button data-id="{{ $data_detail->id }}" type="button"
                                        onclick="showModal(this)"
                                        class="text-indigo-500 flex items-center justify-center hover:text-white hover:bg-indigo-500 p-1 rounded">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                            </path>
                                        </svg>
                                    </button>
                                    @can('opr unstatus delete')
                                        <button data-id="{{ $data_detail->id }}" type="button"
                                            onclick="deleteModal(this)"
                                            class="text-rose-500 flex items-center justify-center hover:text-white hover:bg-rose-500 p-1 rounded">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->date }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->hub }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->awb }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->runsheet }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->employee->nama }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->remark }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->remark_status }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->folluw_up }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data_detail->closed_date }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form id="formInput" method="POST">
                    @csrf
                    <input type="hidden" id="id">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button" onclick="hideModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->

                    <div class="p-6 grid grid-cols-4 gap-4">
                        <div>
                            <label for="awb"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">AWB</label>
                            <input type="text" id="awb" name="awb"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="runsheet"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Runsheet</label>
                            <input type="text" id="runsheet" name="runsheet"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="No. Runsheet" required>
                        </div>
                        <div class="col-span-2">
                            <label for="user_kurir"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User
                                Kurir</label>
                            <select id="user_kurir" name="user_kurir" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->nama }} -
                                        {{ $employee->divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="remark"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Remark</label>
                            <select id="remark" name="remark" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option value="system">System</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div>
                            <label for="remark_status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remark
                                Status</label>
                            <input type="text" id="remark_status" name="remark_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="ex : Lupa Status / Unsycron System" required>
                        </div>
                        <div>
                            <label for="folluw_up"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow
                                Up</label>
                            <input type="text" id="folluw_up" name="folluw_up"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="ex : Done / Syncron System" required>
                        </div>
                        <div>
                            <label for="closed_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Closed
                                Date</label>
                            <input type="date" id="closed_date" name="closed_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="John" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="submit" id="submit"
                            class="disabled:bg-indigo-800 text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Submit</button>
                        <button onclick="hideModal()"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>


        </div>
    </div>

    <div id="createModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-4xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form action="{{ route('opr.openstatus.detail.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="opr_open_status_id" name="opr_open_status_id"
                        value="{{ $data->id }}">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button" onclick="hideCreateModal()"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->

                    <div class="p-6 grid grid-cols-4 gap-4">
                        <div>
                            <label for="awb"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">AWB</label>
                            <input type="text" id="awb" name="awb"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="runsheet"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Runsheet</label>
                            <input type="text" id="runsheet" name="runsheet"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="no. runsheet" required>
                        </div>
                        <div class="col-span-2">
                            <label for="user_kurir"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User
                                Kurir</label>
                            <select id="user_kurir" name="user_kurir" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->nama }} -
                                        {{ $employee->divisi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="remark"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Remark</label>
                            <select id="remark" name="remark" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                                <option value="system">System</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div>
                            <label for="remark_status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remark
                                Status</label>
                            <input type="text" id="remark_status" name="remark_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="ex: lupa status / unsyncron system" required>
                        </div>
                        <div>
                            <label for="folluw_up"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow
                                Up</label>
                            <input type="text" id="folluw_up" name="folluw_up"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="ex: syncron system / done" required>
                        </div>
                        <div>
                            <label for="closed_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Closed
                                Date</label>
                            <input type="date" id="closed_date" name="closed_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="John" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="submit" id="submit"
                            class="disabled:bg-indigo-800 text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Submit</button>
                        <button onclick="hideCreateModal()"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-indigo-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
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
                        <form action="{{ route('opr.openstatus.unstatus.destroy', $data->id) }}" method="POST">
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

    <div id="delete-modal-2" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                    onclick="hideDeleteModall()">
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
                        <form method="POST" id="delForm">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button onclick="hideDeleteModall()" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>

                </div>
            </div>
        </div>
    </div>




    <x-slot name="javascript">
        <script>
            // js for edit
            const targetEl = document.getElementById('defaultModal');
            const options = {
                onShow: async () => {
                    const id = targetEl.getAttribute('data-id');
                    axios.get(`/opr/openstatus/detail/${id}/edit`)
                        .then((response) => {
                            const data = response.data.data
                            targetEl.querySelector('#id').value = data.id
                            targetEl.querySelector('#awb').value = data.awb
                            targetEl.querySelector('#runsheet').value = data.runsheet
                            targetEl.querySelector('#user_kurir').value = data.user_kurir
                            targetEl.querySelector('#remark').value = data.remark
                            targetEl.querySelector('#remark_status').value = data.remark_status
                            targetEl.querySelector('#folluw_up').value = data.folluw_up
                            targetEl.querySelector('#closed_date').value = data.closed_date
                        })
                },
            };


            const modal = new Modal(targetEl, options);


            function showModal(e) {
                targetEl.setAttribute("data-id", e.getAttribute('data-id'))
                modal.show()
            }

            function hideModal() {
                modal.hide()
            }


            const form = document.getElementById('formInput');
            form.addEventListener('submit', (e) => {
                // e.preventDefault()
                const url = `/opr/openstatus/detail/${e.target.querySelector('#id').value}`
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "_method";
                input.value = "PUT";
                e.target.setAttribute('action', url);
                e.target.appendChild(input);
                return true;
            });

            // js for adding
            const createEl = document.getElementById('createModal');
            const modalCreate = new Modal(createEl);

            function craeteModal() {
                modalCreate.show()
            }

            function hideCreateModal() {
                modalCreate.hide()
            }

            // js for delete detail
            const deleteEl = document.getElementById('delete-modal-2');
            const modalDel = new Modal(deleteEl);

            function deleteModal(e) {
                modalDel.show()
                const id = e.getAttribute('data-id');
                let url = `/opr/openstatus/detail/${id}`;
                deleteEl.querySelector('#delForm').setAttribute('action', url);
            }

            function hideDeleteModall() {
                modalDel.hide()
            }
        </script>
    </x-slot>


</x-sidebar-layout>
