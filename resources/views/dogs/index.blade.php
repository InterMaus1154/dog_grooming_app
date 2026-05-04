<x-app>
    <x-slot name="title">Dogs</x-slot>
    <x-slot name="headerTitle">Dogs</x-slot>
    <x-slot name="headerRight">
        <x-button icon="plus" class="text-base bg-brand-dark! text-white" @click="$dispatch('modal-open', {component: 'modal.dog-create'})">
            New <span class="hidden md:inline">Dog</span>
        </x-button>
    </x-slot>
    <x-slot>
        <livewire:dog.dog-list/>
    </x-slot>
</x-app>
