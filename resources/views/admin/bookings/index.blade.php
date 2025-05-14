<x-layout.admin>
    <x-slot:title>
        Admin Panel | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <section class="flex flex-col md:flex-row justify-between gap-6">
            <x-admin.card icon="calendar-days" title="Total Appointments" value="{{ $statistics['total'] }}" mode="2"/>
            <x-admin.card icon="loader" title="Ongoing Appointments" value="{{ $statistics['pending'] }}" mode="2"/>
            <x-admin.card icon="calendar-x" title="Cancelled Appointments" value="{{ $statistics['cancel'] }}" mode="2"/>
            <x-admin.card icon="check-circle-2" title="Completed Appointments" value="{{ $statistics['paid'] }}" mode="2"/>
        </section>
        
        <x-table.bookings :data="$bookings"/>
    </x-admin.main>
</x-layout.admin>