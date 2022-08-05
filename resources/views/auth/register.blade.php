<x-sidebar-layout>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <div class="flex max-w-lg mx-auto">
        <form class="w-full space-y-3" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="employee_id" :value="__('Nama Karyawan')" />


                <select required autofocus name="employee_id" id="employee_id"
                    class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->nama }} - {{ $employee->divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                    required autofocus />
            </div>



            <!-- Email Address -->


            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </div>

</x-sidebar-layout>
