<x-app>
    <x-slot name="title">Dogs</x-slot>
    <x-slot name="headerTitle">Dogs</x-slot>
    <x-slot name="headerRight">
        <x-button icon="plus" class="text-xs sm:text-lg bg-brand-dark! font-bold text-white"
                  @click="$dispatch('modal-open', {component: 'modal.dog-create'})">
            New Dog
        </x-button>
    </x-slot>
    <x-slot>
        <livewire:dog.dog-list/>
    </x-slot>
</x-app>
