<x-sidebar-layout>



    <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
        <div class="flex justify-between items-center">
            <h2 class="text-xl">
                Input Data POD
            </h2>
            <div class="flex justify-start">
                <x-btn-link :href="route('opr.openstatus.unstatus.index')">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <x-btn-label>Back</x-btn-label>
                </x-btn-link>
            </div>
        </div>
    </div>

    <x-error-input-alert :status="session('errors')"></x-error-input-alert>

    <form action="{{ route('opr.openstatus.unstatus.store') }}" method="POST">
        @csrf
        <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3">
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
                        <option value="">Choose a HUB</option>
                        @foreach ($hubs as $hub)
                            <option value="{{ $hub->hub }}">{{ $hub->hub }}</option>
                        @endforeach
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
            <div class="rounded bg-white dark:bg-gray-800 dark:text-white px-4 py-3 w-full mb-3"
                data-group="detail_field">
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
                        <label for="follow_up"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Follow Up</label>
                        <input type="text" id="follow_up" name="follow_up[]"
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
            <x-btn-action type="button" :btntype="'warn'" onclick="addOne()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <x-btn-label>Add Row</x-btn-label>
            </x-btn-action>
            @can('opr unstatus create')
                <x-btn-action type="submit" :btntype="'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <x-btn-label>Submit</x-btn-label>
                </x-btn-action>
            @endcan
        </div>
    </form>



    <x-slot name="javascript">
        <script>
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
