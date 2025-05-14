<x-layout.admin>
    <x-slot:title>
        Admin Panel | Mirra Salon
    </x-slot:title>

    <x-admin.main>
        <section class="flex flex-col md:flex-row justify-between gap-6">
            <x-admin.card icon="wallet" title="Cash Transactions" value="{{ $statistics['cash'] }}" mode="2"/>
            <x-admin.card icon="credit-card" title="Card Transactions" value="{{ $statistics['card'] }}" mode="2"/>
        </section>
        
        <x-table.transactions :data="$transactions"/>
    </x-admin.main>
</x-layout.admin>