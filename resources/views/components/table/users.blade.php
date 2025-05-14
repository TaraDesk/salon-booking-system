@props(['data'])

<x-table.layout heading="Users" for="User" link="/admin/users">
    @if(collect($data)->flatten(1)->isEmpty())
        <div class="p-6 text-center text-gray-600 bg-gray-100 rounded-lg">
            No {{ $for }} records found.
        </div>
    @else
        <table class="w-full text-sm text-left table-auto">
            <colgroup>
                <col class="w-20">
                <col>
                <col>
                <col>
                <col>
            </colgroup>
            <thead class="bg-gray-200 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3">A-Z</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            @foreach ($data as $letter => $records)
                <tbody class="divide-y divide-gray-200">
                    @foreach ($records as $index => $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-xl font-semibold text-gray-600 align-top">
                                {{ $index == 0 ? $letter : '' }}
                            </td>
                            <td class="px-4 py-3 align-middle">{{ $user->name }}</td>
                            <td class="px-4 py-3 align-middle">{{ $user->phone }}</td>
                            <td class="px-4 py-3 align-middle">{{ $user->email }}</td>
                            <td class="px-4 py-3 align-middle text-center">
                                <div class="flex justify-center items-center">
                                    <a href="/admin/users/{{ $user->id }}" class="text-gray-600 hover:text-purple-600" title="View">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            @endforeach
        </table>
    @endif
</x-table.layout>