<x-app>
    <x-slot name="title">Dog Breeds</x-slot>
    <x-slot name="headerTitle">Breeds</x-slot>
    <x-slot name="headerRight">
        <x-button icon="plus" class="bg-brand-dark! font-bold text-white" @click="$dispatch('modal-open', {component: 'modal.dog-breed-create'})">
            New Breed
        </x-button>
    </x-slot>
    <x-slot>
        <livewire:breed.breed-list />
    </x-slot>
</x-app>
