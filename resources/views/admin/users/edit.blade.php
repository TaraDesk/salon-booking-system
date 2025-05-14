<x-layout.admin>
    <x-slot:title>
        Edit User | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="users" child="edit"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">Edit User</h1>
            <p class="text-gray-500 mb-6">Edit User information below.</p>
        
            <form action="/admin/users/{{ $user->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
            
                <div class="space-y-4 text-gray-700">
                    <div class="flex flex-col">
                        <label for="name" class="font-medium mb-1">Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter full name" value="{{ $user->name }}">
                    </div>
            
                    <div class="flex flex-col">
                        <label for="email" class="font-medium mb-1">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter email address" value="{{ $user->email }}">
                    </div>
            
                    <div class="flex flex-col">
                        <label for="phone" class="font-medium mb-1">Phone</label>
                        <input type="tel" id="phone" name="phone"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                            placeholder="Enter phone number" maxlength="14" value="{{ $user->phone }}">
                    </div>
            
                    <div class="flex items-center mt-6">
                        <input type="checkbox" id="is_admin" name="is_admin" {{ $user->is_admin ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_admin" class="ml-2 text-sm font-medium text-gray-700">
                            Grant admin privileges
                        </label>
                    </div>
                </div>
            
                <div class="flex justify-end space-x-4">
                    <a href="/admin/users" class="inline-block px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700 transition">
                        Update User
                    </button>
                </div>
            </form>            
        </div>
    </x-admin.main>
</x-layout.admin>