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
                <div class="flex items-end space-y-2 lg:space-y-0 space-x-0 lg:space-x-2">
                    <x-btn-action type="submit" :btntype="'primary'">
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
                <x-btn-action onclick="downloadIt()" type="button" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <x-btn-label>Export</x-btn-label>
                </x-btn-action>
                <form id="exportReport" action="{{ route('opr.daily-report.dailyperformance.export') }}" method="GET">
                    <input type="hidden" name="from" value="{{ request('from') }}">
                    <input type="hidden" name="thru" value="{{ request('thru') }}">
                    <input type="hidden" name="hub" value="{{ request('hub') }}">
                </form>
            </div>
        </div>


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
                    @foreach ($datas as $data)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6">
                                <button onclick="showModal(this)" data-id="{{ $data->id }}"
                                    class="text-indigo-500 flex items-center justify-center hover:text-white hover:bg-indigo-500 p-1 rounded">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </button>
                            </td>
                            <td class="py-4 px-6">
                                {{ date('d/m/Y', strtotime($data->OprUpdatePod->date)) }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->OprUpdatePod->hub }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->awb }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->runsheet }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->employee->nama }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->remark }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->remark_status }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->follow_up }}
                            </td>
                            <td class="py-4 px-6">
                                {{ $data->closed_date }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        <div class="px-6 py-2">
            {{ $datas->links() }}
        </div>

    </div>

    <div id="editModal" tabindex="-1" aria-hidden="true"
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
                                placeholder="John" required>
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
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="follow_up"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow
                                Up</label>
                            <input type="text" id="follow_up" name="follow_up"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                                placeholder="John" required>
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

    <x-slot name="javascript">
        <script>
            const editEl = document.getElementById('editModal');
            const options = {
                onShow: async () => {
                    const id = editEl.getAttribute('data-id');
                    axios.get(`/opr/daily-report/unstatus-detail/${id}/edit`)
                        .then((response) => {
                            const data = response.data.data
                            editEl.querySelector('#id').value = data.id
                            editEl.querySelector('#awb').value = data.awb
                            editEl.querySelector('#runsheet').value = data.runsheet
                            editEl.querySelector('#user_kurir').value = data.user_kurir
                            editEl.querySelector('#remark').value = data.remark
                            editEl.querySelector('#remark_status').value = data.remark_status
                            editEl.querySelector('#follow_up').value = data.follow_up
                            editEl.querySelector('#closed_date').value = data.closed_date
                        })
                },
            };


            const modal = new Modal(editEl, options);


            function showModal(e) {
                editEl.setAttribute("data-id", e.getAttribute('data-id'))
                modal.show()
            }

            function hideModal() {
                modal.hide()
            }

            function downloadIt() {
                document.getElementById('exportReport').submit()
            }

            const form = document.getElementById('formInput');
            form.addEventListener('submit', (e) => {
                // e.preventDefault()
                const url = `/opr/daily-report/unstatus-detail/${e.target.querySelector('#id').value}`
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "_method";
                input.value = "PUT";
                e.target.setAttribute('action', url);
                e.target.appendChild(input);
                return true;
            });
        </script>
    </x-slot>
</x-sidebar-layout>
