<x-layout.admin>
    <x-slot:title>
        Edit Transaction | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <x-admin.breadcrumb parent="transactions" child="edit"/>

        <div class="w-full mx-auto bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-3xl font-semibold text-gray-800 mb-1">Edit Transaction</h1>
            <p class="text-gray-500 mb-6">Update Transaction information below.</p>
        
            <form action="/admin/transactions/{{ $transaction->id }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
        
                <div class="space-y-4 text-gray-700">
                    <div class="flex flex-col">
                        <label for="booking_id" class="font-medium mb-1">Booking Record</label>
                        <select id="booking_id" name="booking_id" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                            @if ($bookings->isEmpty())
                                <option value="" disabled>No records found</option>
                            @else
                                @foreach ($bookings as $booking)
                                    <option value="{{ $booking->id }}" {{ $transaction->booking_id == $booking->id ? 'selected' : '' }}>Record #{{ $booking->id }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
        
                    <div class="flex flex-col">
                        <label for="payment_date" class="font-medium mb-1">Payment Date</label>
                        <input type="date" id="payment_date" name="payment_date" value="{{ $transaction->payment_date }}" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                    </div>
        
                    <div class="flex flex-col">
                        <label for="payment_method" class="font-medium mb-1">Payment Method</label>
                        <select id="payment_method" name="payment_method" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                            <option value="cash" {{ $transaction->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="card" {{ $transaction->payment_method == 'card' ? 'selected' : '' }}>Card</option>
                        </select>
                    </div>
                </div>
        
                <div class="flex justify-end space-x-4">
                    <a href="/admin/transactions" class="inline-block px-5 py-2 text-sm font-medium text-gray-600 bg-gray-100 rounded hover:bg-gray-200 transition">
                        Cancel
                    </a>
                    <button type="submit" class="px-5 py-2 text-sm font-medium text-white bg-teal-600 rounded hover:bg-teal-700 transition">
                        Update Transaction
                    </button>
                </div>
            </form>
        </div>
    </x-admin.main>
</x-layout.admin>