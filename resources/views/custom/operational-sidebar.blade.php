<div>
    <span class="text-gray-800 font-semibold text-sm dark:text-white">Operasional</span>
</div>
<x-sidebar-navigasi-standart :href="route('opr.daily-report.dailyperformance.summary')" :active="request()->routeIs('opr.daily-report.dailyperformance.summary')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
    </svg>
    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Performa Delivery Sum</span>
</x-sidebar-navigasi-standart>

<hr>

<div>
    <span class="text-gray-800 font-semibold text-sm dark:text-white">Admin POD</span>
</div>
<x-sidebar-navigasi-standart :href="route('opr.daily-report.dailyperformance.index')" :active="request()->routeIs('opr.daily-report.dailyperformance.*')">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
        stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
    </svg>
    <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Performa Delivery</span>
</x-sidebar-navigasi-standart>





<x-sidebar-dropdown :active="request()->routeIs('opr.daily-report.undel.*') || request()->routeIs('opr.daily-report.breach.*')" :name="'Report Undel'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.daily-report.undel.index')" :active="request()->routeIs('opr.daily-report.undel.*')">Undel</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.daily-report.breach.index')" :active="request()->routeIs('opr.daily-report.breach.*')">Breach</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>

<x-sidebar-dropdown :active="request()->routeIs('opr.daily-report.unstatus.*') ||
    request()->routeIs('opr.daily-report.unstatus-detail.*')" :name="'Report POD'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.daily-report.unstatus.index')" :active="request()->routeIs('opr.daily-report.unstatus.*')">Unstatus</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.daily-report.unstatus-detail.index')" :active="request()->routeIs('opr.daily-report.unstatus-detail.*')">Detail Unstatus</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>


@role('super admin')
    <li>
        <button aria-expanded="{{ request()->segment(2) == 'user' ? 'true' : 'false' }}" type="button"
            class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            aria-controls="super-user" data-collapse-toggle="super-user">
            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Super User Only</span>
            <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <ul id="super-user" class="py-2 space-y-2 {{ request()->segment(2) != 'user' ? 'hidden' : '' }}">
            <li>
                <a href="{{ route('su.user.index') }}"
                    class="{{ request()->is('su/user') ? 'bg-gray-200' : '' }} flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">User
                    Management</a>
            </li>
        </ul>
    </li>

    <li>
        <button aria-expanded="{{ request()->segment(2) == 'employee' ? 'true' : 'false' }}" type="button"
            class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
            aria-controls="employee" data-collapse-toggle="employee">
            <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">Employee</span>
            <svg sidebar-toggle-item="" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <ul id="employee" class="py-2 space-y-2 {{ request()->segment(2) != 'employee' ? 'hidden' : '' }}">
            <li>
                <a href="{{ route('mng.employee.index') }}"
                    class="{{ request()->is('mng/employee') ? 'bg-gray-200' : '' }} flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Management
                    Employee</a>
            </li>
        </ul>
    </li>
@endrole
