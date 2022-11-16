<x-sidebar-layout>


    {{-- {{ Auth::user()->roles }} --}}
    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Input Data Undel
            </h2>
            <div class="flex justify-start">
                <a role="button" href="{{ route('opr.undel.index') }}"
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

    <x-error-input-alert :status="session('errors')"></x-error-input-alert>


    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <form action="{{ route('opr.undel.store') }}" method="POST">
            @csrf
            <div class="grid gap-6 mb-6 lg:grid-cols-3">
                <div>
                    <label for="date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Date</label>
                    <input type="date" id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required="" value="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label for="shipper"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Courier /
                        Shipper</label>
                    <select id="shipper" name="shipper" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Choose a Courier</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->nama }} - {{ $employee->jabatan }} | {{ $employee->divisi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="hub"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">HUB</label>
                    <select id="hub" name="hub" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Choose a HUB</option>
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="no_awb"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">No. AWB</label>
                    <input type="text" id="no_awb" name="no_awb"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="35xxxxxxxxxxxx01" required="">
                </div>
                <div>
                    <label for="date_inbound"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Inbound
                        Date</label>
                    <input type="date" id="date_inbound" name="date_inbound"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ date('Y-m-d') }}" required="">
                </div>
                <div>
                    <label for="origin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Origin</label>
                    <input type="text" id="origin" name="origin"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Origin Code" required="">
                </div>
                <div>
                    <label for="consignee"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Consignee</label>
                    <input type="text" id="consignee" name="consignee"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Consignee Name" required="">
                </div>
                <div>
                    <label for="consignee_addr"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Consignee
                        Addr</label>
                    <input type="text" id="consignee_addr" name="consignee_addr"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Consignee Addr" required="">
                </div>
                <div>
                    <label for="phone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Consignee
                        Phone</label>
                    <input type="text" id="phone" name="phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="USING FORMAT 628xxxxxxxxxx" required="">
                </div>
                <div>
                    <label for="goods_desc"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Goods
                        Desc</label>
                    <input type="text" id="goods_desc" name="goods_desc"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Goods Description" required="">
                </div>
                <div>
                    <label for="undel_code"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Undel
                        Status</label>
                    <select id="undel_code" name="undel_code" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Deskripsi
                        Undel</label>
                    <input type="text" id="undel_desc" name="undel_desc"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Deskripsi Undel" required="">
                </div>
                <div>
                    <label for="opr_customer_account_id"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Customer</label>
                    <div class="flex justify-between gap-3">
                        <input type="hidden" id="opr_customer_account_id" name="opr_customer_account_id">
                        <input readonly type="text" id="opr_customer_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Customer ID" required="">
                        <button onclick="modal.show()"
                            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            @can('opr undel create')
                <x-btn-action type="submit" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <x-btn-label>Submit</x-btn-label>
                </x-btn-action>
            @endcan
        </form>
    </div>



    <!-- Modal toggle -->


    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full justify-center items-center">
        <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="p-4">
                    <div class="flex justify-between items-center mb-2">
                        <label for="search"
                            class="block text-sm font-semibold text-gray-900 dark:text-gray-300">First
                            name</label>
                        <button type="button" onclick="closedIt()"
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
                    <input type="text" id="search"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required>
                </div>
                <div class="p-4">

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg max-h-72">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nomor Akun
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Nama Customer Group
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SLA
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="fillData">

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <x-slot name="javascript">
        <script>
            let typingTimer;
            let doneTypingInterval = 700;
            const formInput = document.querySelector('#search');
            const fillData = document.querySelector('#fillData');
            const custID = document.querySelector('#opr_customer_account_id');
            const custName = document.querySelector('#opr_customer_name');
            const targetEl = document.getElementById('defaultModal');
            const modal = new Modal(targetEl);

            formInput.addEventListener('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });

            function selectIt(event) {
                custID.value = event.getAttribute('data-id');
                custName.value = event.getAttribute('data-value');
                modal.hide();
                // console.log(event.getAttribute('data-id'));
            };

            function closedIt() {
                modal.hide();
            }

            async function doneTyping() {
                const inputValue = formInput.value;
                if (inputValue.length > 2) {
                    await axios.get(`{{ route('opr.daily-report.customer.apishow') }}`, {
                        params: {
                            search: inputValue
                        },
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            "content-type": "application/json"
                        }
                    }).then((response) => {
                        if (response.data.data.length == 0) {
                            fillData.innerHTML =
                                '<tr><td colspan="5" class="px-6 py-4">Pencarian tidak ditemukan</td></tr>'
                        } else {
                            fillData.innerHTML = ''
                            generateTables(response.data)
                        }

                    }).catch((error) => {
                        console.log(error);
                    })
                } else {
                    fillData.innerHTML =
                        '<tr><td colspan="5" class="px-6 py-4">Item yang anda cari kurang spesifik</td></tr>'
                };
            };

            function generateTables(params) {
                params.data.forEach(element => {
                    fillData.innerHTML += `
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            ${element.nomor_account}
                        </th>
                        <td class="px-6 py-4">
                            ${element.customer_name}
                        </td>
                        <td class="px-6 py-4">
                            ${element.customer_grouping}
                        </td>
                        <td class="px-6 py-4">
                            ${element.sla_hold}
                        </td>
                        <td class="px-6 py-4 text-right">
                        <button class="text-white px-2 py-1 bg-blue-500 rounded" onclick="selectIt(this)" data-value="${element.nomor_account} - ${element.customer_name}" data-id="${element.id}">Select</button>
                        </td>
                    </tr>
                    `
                });
            }
        </script>
    </x-slot>


</x-sidebar-layout>
