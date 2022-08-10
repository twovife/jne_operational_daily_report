@props(['active', 'name' => 'New Dropdown'])

@php
$buttonClasses = 'flex items-center p-2 w-full text-base font-semibold text-white rounded-lg transition duration-75 group text-white hover:bg-gray-50 hover:bg-opacity-30 dark:text-white dark:hover:bg-gray-700 dark:hover:bg-opacity-40';
if ($active) {
    $isShow = 'true';
} else {
    $isShow = 'false';
}
@endphp

<li x-data="{ open: {{ $isShow }} }">
    <button type="button" class="{{ $buttonClasses }}" @click="open = !open">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item="">{{ $name }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 duration-150 delay-75 "
            :class="{ 'rotate-90': open, '': !open }" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <ul x-show="open" class="space-y-2">
        @isset($sidebarItem)
            {{ $sidebarItem }}
        @endisset
    </ul>
</li>
