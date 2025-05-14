@props(['service', 'mode' => '1'])

@if ($mode == '1')
    <div class="lg:w-1/3 sm:w-1/2 p-4">
        <div class="flex h-full flex-col relative">
            <img alt="gallery" class="absolute inset-0 w-full h-full object-cover object-center" src="{{ asset('storage/' . $service->image_url) }}">
            <div class="px-8 py-10 relative z-10 w-full border-4 border-gray-200 bg-white opacity-0 hover:opacity-100 flex-grow flex flex-col">
                <h2 class="title-font text-lg font-medium text-gray-900 mb-3">{{ $service->name }}</h2>
                <p class="leading-relaxed break-words overflow-hidden text-ellipsis">{{ Str::words($service->description, 15) }}</p>
            </div>
        </div>
    </div>
@elseif ($mode == '2')
    <div class="xl:w-1/4 md:w-1/2 p-4">
        <div class="bg-gray-100 p-6 rounded-lg">
            <img class="h-40 rounded w-full object-cover object-center mb-6" src="{{ asset('storage/' . $service->image_url) }}" alt="content">
            <h3 class="tracking-widest text-indigo-500 text-xs font-medium title-font">{{ 'Rp.' . $service->price . ' - ' . $service->time . ' Minutes'}}</h3>
            <h2 class="text-lg text-gray-900 font-medium title-font mb-4">{{ $service->name }}</h2>
            <p class="leading-relaxed text-base break-words overflow-hidden text-ellipsis">{{ Str::words($service->description, 15) }}</p>
        </div>
    </div>
@endif