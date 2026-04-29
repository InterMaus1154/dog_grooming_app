<x-app>
    <x-slot name="title">Customers</x-slot>
    <x-slot name="headerTitle">Customers</x-slot>
    <x-slot name="headerRight">
        <x-button icon="plus" class="text-xs sm:text-lg bg-brand-dark! font-bold text-white" @click="$dispatch('modal-open', {component: 'modal.customer-create'})">
            New Customer
        </x-button>
    </x-slot>
    <x-slot>
        <livewire:customer.customer-list />
    </x-slot>
</x-app>
