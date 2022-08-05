<x-sidebar-layout>



    <div class="rounded bg-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center mb-3">
            <h2 class="text-xl text-gray-900">
                Input Data POD
            </h2>
            <div class="flex justify-start">
                <a role="button" href="{{ route('opr.daily-report.unstatus.index') }}"
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

    <form action="{{ route('opr.daily-report.unstatus.store') }}" method="POST">
        @csrf
        <div class="rounded bg-white px-4 py-3 w-full mb-3">
            <div class="grid gap-6 mb-6 md:grid-cols-6">
                <div>
                    <label for="date"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 required">Date</label>
                    <input type="date" id="date" name="date"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required="" value="{{ date('Y-m-d') }}">
                </div>
                <div>
                    <label for="hub"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">HUB</label>
                    <select id="hub" name="hub" required=""
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
                    <label for="runsheet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Total
                        AWB Runsheet</label>
                    <input type="number" id="runsheet" name="ttl_runsheet"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required="">
                </div>
            </div>
        </div>
        <div id="asd">
            <div class="rounded bg-white px-4 py-3 w-full mb-3" data-group="detail_field">
                <div class="grid gap-6 mb-6 md:grid-cols-6">
                    <div>
                        <label for="awb"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">AWB</label>
                        <input type="text" id="awb" name="awb[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                    <div>
                        <label for="runsheet"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Runsheet</label>
                        <input type="text" id="runsheet" name="runsheet[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                    <div>
                        <label for="user_kurir"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">User
                            Runsheet</label>
                        <select id="user_kurir" name="user_kurir[]" required=""
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
                        <label for="remark"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 required">Remark</label>
                        <select id="remark" name="remark[]" required=""
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="system">System</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="remark_status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Remark
                            Status</label>
                        <input type="text" id="remark_status" name="remark_status[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                    <div class="col-span-2">
                        <label for="folluw_up"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow Up</label>
                        <input type="text" id="folluw_up" name="folluw_up[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="">
                    </div>
                    <div>
                        <label for="closed_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Closed Date</label>
                        <input type="date" id="closed_date" name="closed_date[]"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required="" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button class="bg-red-500 text-white rounded-full px-2 flex items-center justify-center"
                        type="button" data-type="remover">x</button>
                </div>
            </div>
        </div>
        <div class="flex justify-start items-center gap-3">
            <button type="button" onclick="addOne()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
                Detail</button>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </div>
    </form>



    <x-slot name="javascript">
        <script>
            // function removeIt(event) {
            //     event.parentNode.parentNode.parentNode.remove()
            // }

            document.addEventListener('click', function(event) {
                if (event.target.getAttribute('data-type') == "remover") {
                    const mainParent = event.target.parentNode.parentNode
                    mainParent.remove()
                }
            })

            const detailField = document.querySelector('[data-group="detail_field"]');

            function addOne() {
                let clone = detailField.cloneNode(true);

                if (!detailField) {
                    location.reload();
                } else {
                    document.getElementById('asd').appendChild(clone);
                }
            }
        </script>
    </x-slot>

</x-sidebar-layout>
