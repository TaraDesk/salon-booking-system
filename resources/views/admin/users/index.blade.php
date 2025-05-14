<x-layout.admin>
    <x-slot:title>
        Admin Panel | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <section class="flex flex-col md:flex-row justify-between gap-6">
            <x-admin.card icon="user" title="Total User" value="{{ $statistics['total'] }}" mode="2"/>
            <x-admin.card icon="user-plus" title="New User this Month" value="{{ $statistics['new'] }}" mode="2"/>
        </section>
        
        <x-table.users :data="$users"/>
    </x-admin.main>
</x-layout.admin>