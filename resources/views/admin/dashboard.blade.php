<x-layout.admin>
    <x-slot:title>
        Admin Panel | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <div class="flex items-start p-4 space-x-4 rounded-xl bg-green-50 border border-green-300 text-green-800 shadow-sm mb-6" role="alert">
            <div class="flex-shrink-0">
                <i data-lucide="calendar-check" class="w-5 h-5 mt-1 text-green-600"></i>
            </div>
            <div>
                <h3 class="text-sm font-semibold leading-tight mb-1">
                    Appointments Summary
                </h3>
                <p class="text-sm leading-relaxed">
                    Today is {{ now()->format('F j, Y') }} — the salon has 
                    <span class="font-semibold text-green-900">{{ $statistics['today_appointment'] }} appointments</span> scheduled.
                </p>
            </div>
        </div>                      

        <section class="flex flex-col md:flex-row justify-between gap-6">
            <x-admin.card icon="user-plus" title="New User" value="{{ $statistics['new_user'] }}" />
            <x-admin.card icon="loader" title="Ongoing Appointments" value="{{ $statistics['new_appointment'] }}" />
        </section>

        <div class="container mx-auto py-6 text-gray-800">
            <h2 class="mb-6 text-2xl font-semibold leading-tight">Ongoing Appointments This Month</h2>
        
            @if($bookings->isEmpty())
                <div class="p-6 text-center text-gray-600 bg-gray-100 rounded-lg shadow-sm">
                    No appointments record for this month.
                </div>
            @else
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full text-sm text-left border border-gray-200">
                        <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="p-4">#</th>
                                <th class="p-4">Client</th>
                                <th class="p-4">Service</th>
                                <th class="p-4">Created</th>
                                <th class="p-4">Booked</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $record)
                                <tr class="border-t border-gray-200 hover:bg-gray-50">
                                    <td class="p-4 font-medium text-gray-800">#{{ $record->id }}</td>
                                    <td class="p-4">{{ $record->user->name }}</td>
                                    <td class="p-4">{{ $record->service->name }}</td>
                                    <td class="p-4">{{ $record->issue_at }}</td>
                                    <td class="p-4">{{ $record->booking_date }}</td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                            @if($record->booking_status == 'pending')
                                                bg-yellow-100 text-yellow-700
                                            @elseif($record->booking_status == 'paid')
                                                bg-green-100 text-green-700
                                            @elseif($record->booking_status == 'cancelled')
                                                bg-red-100 text-red-700
                                            @endif
                                        ">
                                            {{ $record->booking_status }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <a href="/admin/bookings/{{ $record->id }}" class="text-gray-600 hover:text-purple-600" title="View">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        

    </x-admin.main>
        
</x-layout.admin>