<x-layout.user>
    <x-slot:title>
        Profiles | Mirra Salon
    </x-slot:title>

    <x-user.overlay background="images/heroes-background.png" />

    <x-user.navbar />

    {{-- Heroes --}}
    <section class="relative text-gray-600 body-font z-3 my-14" id="heroes">
        <div class="container mx-auto flex px-5 py-26 md:flex-row flex-col justify-center items-center">
            <div class="text-center lg:w-2/3 w-full">
                <h2 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                Personalize Your Experience
                </h2>
                <p class="mb-8 leading-relaxed">
                You have the freedom to customize your profile and preferences to make your experience truly your own. Update your settings anytime to ensure we’re always providing the best options tailored to your needs.
                </p>
            </div>
        </div>
    </section>    

    {{-- Profile --}}
    <section class="text-gray-600 body-font pt-21" id="profiles">
        <div class="container px-5 py-24 mx-auto mt-12">
            <div class="grid max-w-6xl grid-cols-1 mx-auto md:grid-cols-2">
                <div class="py-6 px-4 bg-white max-w-xl">
                    <h1 class="text-3xl font-semibold text-gray-800">Your Profile</h1>
                    <p class="text-gray-500 pt-1 mb-8">Here is your personal information</p>
                    
                    <div class="space-y-4 text-gray-700">
                        <!-- Full Name -->
                        <div class="flex items-center">
                        <span class="w-32 font-medium">Full Name:</span>
                        <span>{{ $user->name }}</span>
                        </div>
                    
                        <!-- Email -->
                        <div class="flex items-center">
                        <span class="w-32 font-medium">Email:</span>
                        <span>{{ $user->email }}</span>
                        </div>
                    
                        <!-- Phone -->
                        <div class="flex items-center">
                        <span class="w-32 font-medium">Phone:</span>
                        <span>{{ $user->phone }}</span>
                        </div>
                    </div>

                    <form action="/profile" method="POST" class="mt-10">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="cursor-pointer px-6 py-2 bg-red-100 text-red-600 font-medium rounded hover:bg-red-200 transition">
                        Delete Account
                        </button>
                    </form>
                </div>
                
                <div class="relative p-4">
                    <div id="form-overlay" class="absolute inset-0 bg-white/20 backdrop-blur-sm flex items-center justify-center z-10">
                        <button 
                        onclick="enableEditing()" 
                        class="px-6 py-3 bg-rose-600 text-white text-lg rounded shadow hover:bg-rose-700 focus:outline-none">
                        Edit Your Profile
                        </button>
                    </div>
                    
                    <form id="profile-form" action="/profile" method="POST" class="flex flex-col space-y-6 p-6 md:p-8 bg-white rounded-lg shadow-md pointer-events-none opacity-50 transition">
                        @csrf
                        @method('PATCH')

                        <!-- Full Name -->
                        <label class="block text-gray-700">
                        <span class="mb-1 block font-medium">Full Name</span>
                        <input type="text" placeholder="Enter your Full Name"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-violet-400" 
                            value="{{ $user->name }}" name="name" disabled
                        >
                        </label>

                        <!-- Email Address -->
                        <label class="block text-gray-700">
                        <span class="mb-1 block font-medium">Email Address</span>
                        <input type="email" placeholder="Enter your Email Address" 
                            class="w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-violet-400" 
                            value="{{ $user->email }}" name="email" disabled
                        >
                        </label>

                        <!-- Phone Number -->
                        <label class="block text-gray-700">
                        <span class="mb-1 block font-medium">Phone Number</span>
                        <input type="text" placeholder="+1xxxxxxxxx" maxlength="13"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 bg-gray-50 text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-violet-400 focus:border-violet-400" 
                            value="{{ $user->phone }}" name="phone" disabled
                        >
                        </label>

                        <!-- Submit Button -->
                        <button type="submit" 
                        class="self-center px-8 py-3 text-lg rounded-md font-medium transition focus:outline-none focus:ring focus:ring-opacity-75 bg-rose-600 text-white hover:bg-rose-700 disabled:opacity-70" 
                        disabled
                        >
                        Submit
                        </button>
                    </form>
                </div>        
            </div>
        </div>
    </section> 
    
    {{-- Booking History --}}
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-16 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Booking History</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">To view your booking history, please refer to the table below.</p>
            </div>
            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Service Name</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Booking Date</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Booking Time</th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Booking Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (! $bookings->isEmpty())
                            @foreach ($bookings as $booking)
                            <tr>
                                <td class="px-4 py-3">{{ $booking->service->name }}</td>
                                <td class="px-4 py-3">{{ $booking->booking_date }}</td>
                                <td class="px-4 py-3">{{ $booking->booking_time_start }}</td>
                                <td class="px-4 py-3">{{ $booking->booking_status }}</td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="p-4 text-center">
                                <p>There is no booking history yet</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>


    @if ($errors->any())
    <script>
        Swal.fire({
            icon: "error",
            title: "{{ $errors->first() }}",
            text: "Something went wrong!"
        });
    </script>
    @endif

    @if (session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}"
        });
    </script>
    @endif

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
</x-layout.user>