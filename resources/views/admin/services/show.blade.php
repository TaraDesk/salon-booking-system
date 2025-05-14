<x-layout.admin>
    <x-slot:title>
        Service Record | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="services" child="{{ $service->id }}"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/3">
                    <img src="{{ asset('storage/' . $service->image_url) }}" alt="{{ $service->name }}" class="object-cover w-full h-full">
                </div>
        
                <div class="md:w-2/3 p-6 flex flex-col justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $service->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $service->description }}</p>
        
                        <div class="grid grid-cols-2 gap-4 text-sm text-gray-700">
                            <div>
                                <span class="font-semibold">Price:</span>
                                <p>Rp. {{ number_format($service->price, 2) }}</p>
                            </div>
                            <div>
                                <span class="font-semibold">Duration:</span>
                                <p>{{ $service->time }} minutes</p>
                            </div>
                            <div>
                                <span class="font-semibold">Created On:</span>
                                <p>{{ $service->created_at->format('F d, Y') }}</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="mt-6 flex space-x-4">
                        <a href="/admin/services/{{ $service->id }}/edit" 
                            class="inline-block px-5 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 transition">
                             Edit Service
                         </a>
                 
                         <form action="/admin/services/{{ $service->id }}" method="POST">
                             @csrf
                             @method('DELETE')
                             <button type="submit" 
                                     class="inline-block px-5 py-2 text-sm font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 transition">
                                 Delete Service
                             </button>
                         </form>
                    </div>
                </div>
            </div>
        </div>
        
    </x-admin.main>
</x-layout.admin>