<div>
    <span class="text-gray-800 font-semibold text-sm dark:text-white">Delivery</span>
</div>
<x-sidebar-dropdown :active="request()->routeIs('opr.dailyperformance.nonexpress.*') ||
    request()->routeIs('opr.dailyperformance.express.*')" :name="'Daily Performance'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.dailyperformance.express.index')" :active="request()->routeIs('opr.dailyperformance.express.*')">Yes</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.dailyperformance.nonexpress.index')" :active="request()->routeIs('opr.dailyperformance.nonexpress.*')">Non Yes</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>

<x-sidebar-dropdown :active="request()->routeIs('opr.dailyperformance.nonexpress.*') ||
    request()->routeIs('opr.dailyperformance.express.*')" :name="'Undel'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.undel.index')" :active="request()->routeIs('opr.dailyperformance.express.*')">Undel</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.dailyperformance.nonexpress.index')" :active="request()->routeIs('opr.dailyperformance.nonexpress.*')">Breach</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>

<hr>
