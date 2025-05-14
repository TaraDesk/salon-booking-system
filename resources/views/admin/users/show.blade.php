<x-layout.admin>
    <x-slot:title>
        User Record | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="users" child="{{ $user->id }}"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">User Details</h1>
            <p class="text-gray-500 mb-6">Manage User details below.</p>
    
            <!-- Avatar and Info -->
            <div class="flex items-center space-x-4 mb-6">
                <img src="http://i.pravatar.cc/300" alt="Avatar of User" class="w-16 h-16 rounded-full object-cover">
                <div>
                    <p class="font-medium text-lg text-gray-800">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">Account since {{ $user->created_at->format('F Y') }}</p>
                </div>
            </div>
    
            <!-- Personal Information -->
            <div class="space-y-4 text-gray-700">
                <div class="flex">
                    <span class="w-32 font-medium">Full Name:</span>
                    <span>{{ $user->name }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 font-medium">Email:</span>
                    <span>{{ $user->email }}</span>
                </div>
                <div class="flex">
                    <span class="w-32 font-medium">Phone:</span>
                    <span>{{ $user->phone }}</span>
                </div>
            </div>
        
            <div class="mt-8 flex space-x-4">
                <a href="/admin/users/{{ $user->id }}/edit" 
                   class="inline-block px-5 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 transition">
                    Edit User
                </a>
        
                <form action="/admin/users/{{ $user->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-block px-5 py-2 text-sm font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 transition">
                        Delete User
                    </button>
                </form>
            </div>
        </div>        
    </x-admin.main>
</x-layout.admin>