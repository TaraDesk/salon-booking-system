@props(['data'])

<x-table.layout heading="Appointments" for="Appointment" link="/admin/bookings">
    @if ($data->isEmpty())
        <div class="p-6 text-center text-gray-600 bg-gray-100 rounded-lg shadow-sm">
            No appointment records found.
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col class="w-12">
                </colgroup>
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Client</th>
                        <th class="p-3">Service</th>
                        <th class="p-3">Appointment Time - Start</th>
                        <th class="p-3">Appointment Time - End</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 align-middle">#{{ $record->id }}</td>
                            <td class="p-3 align-middle">{{ $record->user->name }}</td>
                            <td class="p-3 align-middle">{{ $record->service->name }}</td>
                            <td class="p-3 align-middle">{{ $record->booking_date }} at {{ $record->booking_time_start }}</td>
                            <td class="p-3 align-middle">{{ $record->booking_date }} at {{ $record->booking_time_end }}</td>
                            <td class="p-3 align-middle">
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
                            <td class="p-3 text-center align-middle">
                                <div class="flex justify-center items-center">
                                    <a href="/admin/bookings/{{ $record->id }}" class="text-gray-600 hover:text-purple-600" title="View">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-table.layout>