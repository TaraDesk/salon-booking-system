<x-layout.admin>
    <x-slot:title>
        Edit Booking | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="bookings" child="edit"/>
            
        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">Edit Booking</h1>
            <p class="text-gray-500 mb-6">Update booking information below.</p>
        
            <form action="/admin/bookings/{{ $booking->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
        
                <div class="space-y-4 text-gray-700">
                    <div class="flex flex-col">
                        <label for="service_id" class="font-medium mb-1">Service Name</label>
                        <select id="service_id" name="service_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}" {{ $booking->service->id === $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="flex flex-col">
                        <label for="user_id" class="font-medium mb-1">Client Name</label>
                        <select id="user_id" name="user_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $booking->user->id === $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="flex flex-col">
                        <label for="booking_date" class="font-medium mb-1">Booking Date</label>
                        <input type="date" id="booking_date" name="booking_date" value="{{ $booking->booking_date }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                    </div>
        
                    <div class="flex flex-col">
                        <label for="booking_time" class="font-medium mb-1">Booking Time</label>
                        <select id="booking_time" name="booking_time" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                            @for ($hour = 9; $hour <= 17; $hour++)
                                <option value="{{ sprintf('%02d:00', $hour) }}" {{ $booking->booking_time_start === sprintf('%02d:00:00', $hour) ? 'selected' : '' }}>
                                    {{ sprintf('%02d:00', $hour) }}
                                </option>
                                <option value="{{ sprintf('%02d:30', $hour) }}" {{ $booking->booking_time_start === sprintf('%02d:30:00', $hour) ? 'selected' : '' }}>
                                    {{ sprintf('%02d:30', $hour) }}
                                </option>
                            @endfor
                        </select>
                    </div>
        
                    <div class="flex flex-col">
                        <label for="booking_status" class="font-medium mb-1">Booking Status</label>
                        <select id="booking_status" name="booking_status" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                            <option value="pending" {{ $booking->booking_status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $booking->booking_status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ $booking->booking_status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
        
                <div class="flex justify-end space-x-4">
                    <a href="/admin/bookings" class="inline-block px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700 transition">
                        Update Booking
                    </button>
                </div>
            </form>
        </div>

        @if (session('overlapping'))
            <script>
                Swal.fire({
                    icon: "error",
                    title: "{{ session('overlapping') }}",
                    text: "Something went wrong!"
                });
            </script>
        @endif
    </x-admin.main>
</x-layout.admin>