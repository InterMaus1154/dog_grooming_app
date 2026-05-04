<x-app>
    <x-slot name="title">Bookings</x-slot>
    <x-slot name="headerTitle">Bookings</x-slot>
    <x-slot name="headerRight">
        <x-button icon="plus" class="text-base bg-brand-dark! text-white"
                  @click="$dispatch('modal-open', {component: 'modal.booking-create'})">Book
        </x-button>
    </x-slot>
    <x-slot>
        <livewire:booking.booking-list />
    </x-slot>
</x-app>
