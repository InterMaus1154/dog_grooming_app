<x-app title="Dashboard" headerTitle="Dashboard">
    <x-slot name="headerRight">
        <x-button icon="plus" class="text-base bg-brand-dark! text-white"
                  @click="$dispatch('modal-open', {component: 'modal.booking-create'})">Book
        </x-button>
    </x-slot>
    <livewire:booking.booking-calendar/>
    <p class="italic mt-4 text-right">Click on a slot to create a booking</p>
</x-app>
