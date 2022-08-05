<x-sidebar-layout>



    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Input Data Undel
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

    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="grid gap-6 mb-6 md:grid-cols-6">
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
                <label for="ttl_runsheet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                    AWB Runsheet</label>
                <input type="number" id="ttl_runsheet" name="ttl_runsheet"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required="" value="{{ $data->ttl_runsheet }}">
            </div>
        </div>
    </div>
    <div class="rounded bg-white px-4 py-3 w-full mb-3">

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
                    @foreach ($data->oprPodDetail as $data_detail)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6">
                                <button data-id="{{ $data_detail->id }}" type="button" onclick="showModal(this)"
                                    class="text-indigo-500 flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                        </path>
                                    </svg>
                                </button>
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
                <form id="formInput">
                    <!-- Modal header -->
                    <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terms of Service
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="defaultModal">
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

                    <div class="p-6 grid grid-cols-3 gap-3">
                        <div>
                            <label for="awb"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">AWB</label>
                            <input type="text" id="awb" name="awb"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="runsheet"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Runsheet</label>
                            <input type="text" id="runsheet" name="runsheet"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="user_kurir"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">User
                                Kurir</label>
                            <input type="text" id="user_kurir" name="user_kurir"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="remark"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Remark</label>
                            <select id="remark" name="remark[]" required=""
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="system">System</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div>
                            <label for="remark_status"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remark
                                Status</label>
                            <input type="text" id="remark_status" name="remark_status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="folluw_up"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow
                                Up</label>
                            <input type="text" id="folluw_up" name="folluw_up"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                        <div>
                            <label for="closed_date"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Closed
                                Date</label>
                            <input type="date" id="closed_date" name="closed_date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="John" required>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                        class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I
                            accept</button>
                        <button onclick="hideModal()"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                </form>
            </div>


        </div>
    </div>


    <x-slot name="javascript">
        <script>
            const targetEl = document.getElementById('defaultModal');
            const options = {
                onShow: async () => {
                    // console.log();
                    const id = targetEl.getAttribute('data-id');
                    axios.get(`/opr/daily-report/unstatus-detail/${id}/edit`)
                        .then((response) => {
                            const data = response.data.data
                            let remarkOpt = new Option(data.remark, data.remark, true, true)
                            targetEl.querySelector('#awb').value = data.awb
                            targetEl.querySelector('#runsheet').value = data.runsheet
                            targetEl.querySelector('#user_kurir').value = data.user_kurir
                            targetEl.querySelector('#remark').appendChild(remarkOpt)
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
        </script>
    </x-slot>


</x-sidebar-layout>
