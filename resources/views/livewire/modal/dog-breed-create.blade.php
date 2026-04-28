<x-modal.wrapper>
    <x-slot name="title">Add New Breed</x-slot>
    <x-slot name="subtitle">All fields marked with <span class="text-red-500">*</span> is mandatory!</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent wire:submit="save()">
            <x-form.wrapper>
                <x-form.label>Breed Name</x-form.label>
                <x-form.input type="text" placeholder="Breed Name" required/>
            </x-form.wrapper>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-modal.generic-footer />
    </x-slot>
</x-modal.wrapper>
