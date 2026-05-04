<x-app>
    <x-slot name="title">Customers</x-slot>
    <x-slot name="headerTitle">Customers</x-slot>
    <x-slot name="headerRight">
        <x-button icon="plus" class="bg-brand-dark! text-white" @click="$dispatch('modal-open', {component: 'modal.customer-create'})">
            New <span class="hidden md:inline">Customer</span>
        </x-button>
    </x-slot>
    <x-slot>
        <livewire:customer.customer-list />
    </x-slot>
</x-app>
