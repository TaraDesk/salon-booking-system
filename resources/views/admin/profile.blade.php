<x-layout.admin>
    <x-slot:title>
        Admin Profile | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <div class="w-full grid mx-auto grid-cols-1 md:grid-cols-2 gap-8">
    
            <!-- Left Panel: Profile Display -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h1 class="text-3xl font-semibold text-gray-800 mb-1">Your Profile</h1>
                <p class="text-gray-500 mb-6">Manage your personal details below.</p>
        
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
        
                @if ($admin_user > 1)
                    <form action="/profile" method="POST" class="mt-8">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-2 inline-block px-5 py-2 text-sm font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 transition">
                            Delete Account 
                        </button>
                    </form>
                @endif
            </div>
        
            <!-- Right Panel: Profile Form -->
            <div class="relative">
                <div id="form-overlay" class="absolute inset-0 bg-white/40 backdrop-blur-md flex items-center justify-center z-10 rounded-lg">
                    <button onclick="enableEditing()" class="px-6 py-3 bg-purple-600 text-white text-lg rounded shadow hover:bg-purple-700 focus:outline-none">
                        Edit Your Profile
                    </button>
                </div>
        
                <form id="profile-form" action="/admin/profile" method="POST" class="pointer-events-none opacity-50 bg-white rounded-xl shadow-sm p-6 space-y-6 transition">
                    @csrf
                    @method('PATCH')
        
                    <label class="block text-gray-700">
                        <span class="mb-1 block font-medium">Full Name</span>
                        <input type="text" name="name" placeholder="Enter your Full Name"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                               value="{{ $user->name }}" disabled>
                    </label>
        
                    <label class="block text-gray-700">
                        <span class="mb-1 block font-medium">Email Address</span>
                        <input type="email" name="email" placeholder="Enter your Email Address"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                               value="{{ $user->email }}" disabled>
                    </label>
        
                    <label class="block text-gray-700 mb-14">
                        <span class="mb-1 block font-medium">Phone Number</span>
                        <input type="text" name="phone" maxlength="14" placeholder="+1xxxxxxxxx"
                               class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-50 text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-400"
                               value="{{ $user->phone }}" disabled>
                    </label>
        
                    <button type="submit"
                            class="w-full py-3 text-lg font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-400"
                            disabled>
                        Submit Changes
                    </button>
                </form>
            </div>
        </div>
    </x-admin.main>    

    <script>
        function enableEditing() {
            const form = document.getElementById('profile-form');
            const overlay = document.getElementById('form-overlay');
        
            // Enable form interactions
            form.classList.remove('pointer-events-none', 'opacity-50');
            const inputs = form.querySelectorAll('input, textarea, button');
            inputs.forEach(input => input.removeAttribute('disabled'));
        
            // Hide the overlay
            overlay.classList.add('hidden');
        }
    </script>
</x-layout.admin>