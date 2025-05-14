@props(['data'])

<x-table.layout heading="Transactions" for="Transaction" link="/admin/transactions">
    @if ($data->isEmpty())
        <div class="p-6 text-center text-gray-600 bg-gray-100 rounded-lg shadow-sm">
            No Transaction records found.
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr class="text-left">
                        <th class="p-3">#</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Client</th>
                        <th class="p-3">Service</th>
                        <th class="p-3">Method</th>
                        <th class="p-3">Total</th>                    
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 align-middle">{{ $record->id }}</td>
                            <td class="p-3 align-middle">{{ $record->payment_date }}</td>
                            <td class="p-3 align-middle">{{ $record->booking->user->name }}</td>
                            <td class="p-3 align-middle">{{ $record->booking->service->name }}</td>
                            <td class="p-3 align-middle">
                                <span class="inline-block px-3 py-1 text-sm font-medium rounded-md
                                @if($record->payment_method == 'cash')
                                    bg-purple-100 text-purple-700
                                @elseif($record->payment_method == 'card')
                                    bg-violet-100 text-violet-700
                                @endif
                                ">
                                    {{ ucfirst($record->payment_method) }}
                                </span>
                            </td>
                            <td class="p-3 align-middle">Rp.{{ $record->payment_total }}</td>
                            <td class="p-3 text-center align-middle">
                                <div class="flex justify-center items-center">
                                    <a href="/admin/transactions/{{ $record->id }}" class="text-gray-600 hover:text-purple-600" title="View">
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