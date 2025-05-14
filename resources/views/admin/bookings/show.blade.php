<x-layout.admin>
    <x-slot:title>
        Booking Record | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="bookings" child="{{ $booking->id }}"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">Booking Details</h1>
            <p class="text-gray-500 mb-6">Manage booking information below.</p>
        
            <!-- Booking Info -->
            <div class="space-y-4 text-gray-700">
                <div class="flex">
                    <span class="w-40 font-medium">Booking Number:</span>
                    <span>{{ $booking->id }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Service Name:</span>
                    <span>{{ $booking->service->name }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Client Name:</span>
                    <span>{{ $booking->user->name }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Booking Date:</span>
                    <span>{{ $booking->booking_date }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Time Start:</span>
                    <span>{{ $booking->booking_time_start }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Time End:</span>
                    <span>{{ $booking->booking_time_end }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Created At:</span>
                    <span>{{ $booking->created_at->format('F j, Y g:i A') }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Booking Status:</span>
                    <span>{{ ucfirst($booking->booking_status) }}</span>
                </div>
            </div>
        
            <div class="mt-8 flex space-x-4">
                <a href="/admin/bookings/{{ $booking->id }}/edit" 
                   class="inline-block px-5 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 transition">
                    Edit Booking
                </a>
        
                <form action="/admin/bookings/{{ $booking->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-block px-5 py-2 text-sm font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 transition">
                        Delete Booking
                    </button>
                </form>
            </div>
        </div>        
    </x-admin.main>
</x-layout.admin>