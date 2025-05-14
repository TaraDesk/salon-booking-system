<x-layout.admin>
    <x-slot:title>
        Create Service | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="services" child="create"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">Create Service</h1>
            <p class="text-gray-500 mb-6">Enter Service information below.</p>
        
            <form action="/admin/services" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
        
                <div class="space-y-4 text-gray-700">
                    <div class="flex flex-col">
                        <label for="name" class="font-medium mb-1">Service Name</label>
                        <input type="text" id="name" name="name" required value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter service name">
                    </div>
        
                    <div class="flex flex-col">
                        <label for="description" class="font-medium mb-1">Description</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter service description">{{ old('description') }}</textarea>
                    </div>
        
                    <div class="flex flex-col">
                        <label for="image" class="font-medium mb-1">Image</label>
                        <input type="file" id="image" name="image"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                    </div>
        
                    <div class="flex flex-col">
                        <label for="time" class="font-medium mb-1">Time (in minutes)</label>
                        <input type="number" id="time" name="time" min="1" required value="{{ old('time') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter duration in minutes">
                    </div>
        
                    <div class="flex flex-col">
                        <label for="price" class="font-medium mb-1">Price (Rp)</label>
                        <input type="number" id="price" name="price" step="0.01" required value="{{ old('price') }}"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter service price">
                    </div>
                </div>
        
                <div class="flex justify-end space-x-4">
                    <a href="/admin/services" class="inline-block px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700 transition">
                        Create Service
                    </button>
                </div>
            </form>
        </div>
        
    </x-admin.main>
</x-layout.admin>