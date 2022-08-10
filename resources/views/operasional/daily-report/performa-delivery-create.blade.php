<x-sidebar-layout>

    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl">
                Input Data Performa Delivery
            </h2>
            <div class="flex justify-start">
                <x-btn-link :href="route('opr.daily-report.dailyperformance.index')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Back</span>
                </x-btn-link>
            </div>
        </div>
    </div>

    <x-error-input-alert :status="session('errors')"></x-error-input-alert>

    <form action="{{ route('opr.daily-report.dailyperformance.store') }}" method="POST">
        @csrf
        <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
            <div class="grid gap-6 mb-6 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <label for="inbound_date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Inbound
                        Date</label>
                    <input value="{{ old('date') }}" type="date" id="inbound_date" name="inbound_date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        placeholder="John" required="">
                </div>
                <div>
                    <label for="zone"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Select
                        Zone</label>
                    <select value="{{ old('zone') }} id="zone" name="zone" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        <option value="">Choose a Zone</option>
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
                    <select value="{{ old('hub') }}" id="hub" name="hub" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                        @if (Auth::user()->roles->where('name', 'opr pod')->first())
                            <option value="{{ Auth::user()->employee->hub }}">{{ Auth::user()->employee->hub }}
                            </option>
                        @else
                            <option value="">Choose a HUB</option>
                            <option value="NGADILUWIH">NGADILUWIH</option>
                            <option value="PARE">PARE</option>
                            <option value="BANJARAN">BANJARAN</option>
                            <option value="BANYAKAN">BANYAKAN</option>
                        @endif

                    </select>
                </div>
                <div>
                    <label for="total_shipment_cod"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Total Shipment
                        COD</label>
                    <input value="{{ old('total_shipment_cod') }}" type="number" id="total_shipment_cod"
                        name="total_shipment_cod"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="total_nominal_cod"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Total Nominal
                        COD
                        URL</label>
                    <input value="{{ old('total_nominal_cod') }}" type="number" id="total_nominal_cod"
                        name="total_nominal_cod"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
            </div>
        </div>

        <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full b-3">
            <h2 class="text-xl mb-4">Report H+0</h2>
            <div class="grid gap-6 mb-6 lg:grid-cols-7">
                <div>
                    <label for="total_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Total
                        Cnote</label>
                    <input data-name="sumit" value="{{ old('total_0') }}" type="number" id="total_0" name="total_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="ur_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Un
                        Runsheet</label>
                    <input data-name="sumit" value="{{ old('ur_0') }}" type="number" id="ur_0" name="ur_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="d_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Delivered</label>
                    <input min="0" readonly value="{{ old('d_0') }}" type="number" id="d_0"
                        name="d_0"
                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="cr_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">CR</label>
                    <input data-name="sumit" value="{{ old('cr_0') }}" type="number" id="cr_0"
                        name="cr_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="u_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Undel</label>
                    <input data-name="sumit" value="{{ old('u_0') }}" type="number" id="u_0"
                        name="u_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="o_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Un
                        Status</label>
                    <input data-name="sumit" value="{{ old('o_0') }}" type="number" id="o_0"
                        name="o_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
                <div>
                    <label for="r_0"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Return</label>
                    <input data-name="sumit" value="{{ old('r_0') }}" type="number" id="r_0"
                        name="r_0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500"
                        required="">
                </div>
            </div>
            @can('opr daily create')
                <x-btn-action type="submit" :btntype="'success'">
                    <span>Submit</span>
                </x-btn-action>
            @endcan
        </div>
    </form>


    <x-slot name="javascript">
        <script>
            const inputFiller = document.querySelectorAll('[data-name="sumit"]')
            // console.log(inputFiller);
            inputFiller.forEach(element => {
                element.addEventListener('change', function(e) {
                    document.querySelector('#d_0').value = sumAll()
                    // alert('asd')
                })
            });

            const sumAll = () => {
                const total_cnote = document.querySelector('#total_0').value
                const un_runsheet = document.querySelector('#ur_0').value
                const cr = document.querySelector('#cr_0').value
                const undel = document.querySelector('#u_0').value
                const un_status = document.querySelector('#o_0').value
                const rt = document.querySelector('#r_0').value

                return total_cnote - un_runsheet - cr - undel - un_status - rt
            }
        </script>
    </x-slot>

</x-sidebar-layout>
