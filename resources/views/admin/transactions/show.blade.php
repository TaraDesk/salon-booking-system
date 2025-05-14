<x-layout.admin>
    <x-slot:title>
        Transaction Record | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="bookings" child="{{ $transaction->id }}"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">Transaction Details</h1>
            <p class="text-gray-500 mb-6">Manage transaction information below.</p>
        
            <!-- Booking Info -->
            <div class="space-y-4 text-gray-700">
                <div class="flex">
                    <span class="w-40 font-medium">Booking Number:</span>
                    <span>{{ $transaction->booking->id }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Service Name:</span>
                    <span>{{ $transaction->booking->service->name }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Client Name:</span>
                    <span>{{ $transaction->booking->user->name }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Booking Date:</span>
                    <span>{{ $transaction->booking->booking_date }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Booking Time:</span>
                    <span>{{ $transaction->booking->booking_time_start }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Payment Date:</span>
                    <span>{{ $transaction->payment_date }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Payment Total:</span>
                    <span>{{ $transaction->payment_total }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-medium">Payment Method:</span>
                    <span>{{ ucfirst($transaction->payment_method) }}</span>
                </div>
            </div>
        
            <div class="mt-8 flex space-x-4">
                <a href="/admin/transactions/{{ $transaction->id }}/edit" 
                   class="inline-block px-5 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded hover:bg-blue-200 transition">
                    Edit Transaction
                </a>
        
                <form action="/admin/transactions/{{ $transaction->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-block px-5 py-2 text-sm font-medium text-red-600 bg-red-100 rounded hover:bg-red-200 transition">
                        Delete Transaction
                    </button>
                </form>
            </div>
        </div>        
    </x-admin.main>
</x-layout.admin>