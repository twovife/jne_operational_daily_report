@role('super admin')
    <div>
        <span class="text-gray-800 font-semibold text-sm dark:text-white">Admin Operasional</span>
    </div>
    <x-sidebar-dropdown :active="request()->routeIs('opr.dailyperformance.summary.*') ||
        request()->routeIs('opr.dailyperformance.express.*')" :name="'Summary Performance'">
        <x-slot name="sidebarItem">
            <x-sidebar-dropdown-item :href="route('opr.dailyperformance.summary.express.index')" :active="request()->routeIs('opr.dailyperformance.summary.express.*')">Yes</x-sidebar-dropdown-item>
            <x-sidebar-dropdown-item :href="route('opr.dailyperformance.summary.nonexpress.index')" :active="request()->routeIs('opr.dailyperformance.summary.nonexpress.*')">Non Yes</x-sidebar-dropdown-item>
            <x-sidebar-dropdown-item :href="route('opr.dailyperformance.summary.ctc.index')" :active="request()->routeIs('opr.dailyperformance.summary.ctc.*')">CTC</x-sidebar-dropdown-item>
        </x-slot>
    </x-sidebar-dropdown>
    <hr>
@endrole


<div>
    <span class="text-gray-800 font-semibold text-sm dark:text-white">Delivery</span>
</div>
<x-sidebar-dropdown :active="request()->routeIs('opr.dailyperformance.nonexpress.*') ||
    request()->routeIs('opr.dailyperformance.express.*') ||
    request()->routeIs('opr.dailyperformance.ctc.*')" :name="'Daily Performance'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.dailyperformance.express.index')" :active="request()->routeIs('opr.dailyperformance.express.*')">Yes</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.dailyperformance.nonexpress.index')" :active="request()->routeIs('opr.dailyperformance.nonexpress.*')">Non Yes</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.dailyperformance.ctc.index')" :active="request()->routeIs('opr.dailyperformance.ctc.*')">CTC</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>

<x-sidebar-dropdown :active="request()->routeIs('opr.undel.*') || request()->routeIs('opr.breach.*')" :name="'Undel'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.undel.index')" :active="request()->routeIs('opr.undel.*')">Undel</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.breach.index')" :active="request()->routeIs('opr.breach.*')">Breach</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>

<x-sidebar-dropdown :active="request()->routeIs('opr.openstatus.*')" :name="'Open Status'">
    <x-slot name="sidebarItem">
        <x-sidebar-dropdown-item :href="route('opr.openstatus.unstatus.index')" :active="request()->routeIs('opr.openstatus.unstatus.*')">Open Pod</x-sidebar-dropdown-item>
        <x-sidebar-dropdown-item :href="route('opr.openstatus.detail.index')" :active="request()->routeIs('opr.openstatus.detail.*')">Detail Open POD</x-sidebar-dropdown-item>
    </x-slot>
</x-sidebar-dropdown>

<hr>
