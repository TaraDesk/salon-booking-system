@props(['data'])

<x-table.layout heading="Services" for="service" link="/admin/services">
    @if ($data->isEmpty())
        <div class="p-6 text-center text-gray-600 bg-gray-100 rounded-lg shadow-sm">
            No booking records found.
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left">
                <colgroup>
                    <col>
                    <col>
                    <col>
                    <col>
                    <col class="w-12">
                </colgroup>
                <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="p-3">Name</th>
                        <th class="p-3">Description</th>
                        <th class="p-3">Time</th>
                        <th class="p-3">Price</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($data as $record)
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 align-middle">{{ $record->name }}</td>
                            <td class="p-3 align-middle">{{ Str::words($record->description, 10) }}</td>
                            <td class="p-3 align-middle">{{ $record->time }} Minutes</td>
                            <td class="p-3 align-middle">Rp.{{ number_format($record->price, 2) }}</td>
                            <td class="p-3 text-center align-middle">
                                <div class="flex justify-center items-center">
                                    <a href="/admin/services/{{ $record->id }}" class="text-gray-600 hover:text-purple-600" title="View">
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