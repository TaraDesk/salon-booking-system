<x-layout.admin>
    <x-slot:title>
        Admin Panel | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <section class="flex flex-col md:flex-row justify-between gap-6">
            <x-admin.card icon="briefcase" title="Total Services" value="{{ $statistics['total'] }}" mode="2"/>
            <x-admin.card icon="star" title="Most Popular Service" value="{{ $statistics['popular'] }}" mode="2"/>
        </section>
        
        <x-table.services :data="$services"/>
    </x-admin.main>
</x-layout.admin>