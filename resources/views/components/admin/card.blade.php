@props(['icon', 'title', 'value', 'date' => "This month", 'mode' => '1'])

@if ($mode == '1')
<div class="w-full p-6 bg-white shadow-xl rounded-2xl transition-transform hover:scale-[1.02]">
    <div class="flex items-center space-x-4">
        <div class="p-4 bg-purple-100 rounded-xl relative">
            <i data-lucide="{{ $icon }}" class="h-5 w-5 text-purple-600 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
        </div>
        <h2 class="text-lg font-semibold text-gray-800">
            {{ $title }}
        </h2>
    </div>
    <div class="mt-6 flex items-baseline space-x-2">
        <p class="text-3xl font-bold text-gray-800">
            {{ $value }}
        </p>
        <span class="text-sm text-gray-500">
            {{ $date }}
        </span>
    </div>
</div>

@elseif ($mode == '2')
<div class="w-full flex items-center p-6 space-x-6 rounded-2xl shadow-md bg-white transition-transform hover:scale-[1.02]">
    <div class="flex items-center justify-center p-4 bg-purple-100 rounded-xl">
        <i data-lucide="{{ $icon }}" class="h-7 w-7 text-purple-600"></i>
    </div>
    <div class="flex flex-col justify-center">
        <p class="text-3xl font-bold text-gray-800">
            {{ $value }}
        </p>
        <p class="mt-1 text-sm font-medium text-gray-500 capitalize">
            {{ $title }}
        </p>
    </div>
</div>

@endif
