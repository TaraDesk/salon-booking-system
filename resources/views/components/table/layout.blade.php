@props(['heading', 'for', 'link'])

<div class="container mx-auto py-6 text-gray-800">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold leading-tight">{{ $heading }}</h2>
        <a href="{{ $link }}/create" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-purple-600 rounded-full hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-400">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add {{ $for }}
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow mt-6">
        {{ $slot }}
    </div>
</div>
