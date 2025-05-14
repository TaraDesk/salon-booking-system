@props(['parent', 'child'])

@php
    if (is_numeric($child)) {
        $child_name = 'Record #' . $child;
    } else {
        $child_name = ucfirst($child) . ' Record';
    }
@endphp

<nav aria-label="breadcrumb" class="container mx-auto p-2 dark:bg-gray-100 dark:text-gray-800">
    <ol class="flex h-8 space-x-2">
        <li class="flex items-center">
            <a rel="noopener noreferrer" href="/admin/dashboard" title="Back to homepage" class="hover:underline">
                <i data-lucide="home" class="w-5 h-5 pr-1 dark:text-gray-600"></i>
            </a>
        </li>
        <li class="flex items-center space-x-2">
            <i data-lucide="chevron-right" class="w-4 h-4 mt-0.5 dark:text-gray-400"></i>
            <a rel="noopener noreferrer" href="/admin/{{ $parent }}" class="flex items-center px-1 capitalize hover:underline">{{ ucfirst($parent) }}</a>
        </li>
        <li class="flex items-center space-x-2">
            <i data-lucide="chevron-right" class="w-4 h-4 mt-0.5 dark:text-gray-400"></i>
            <a rel="noopener noreferrer" href="/admin/{{ $parent }}/{{ $child }}" class="flex items-center px-1 capitalize hover:underline">{{ $child_name }}</a>
        </li>
    </ol>
</nav>
