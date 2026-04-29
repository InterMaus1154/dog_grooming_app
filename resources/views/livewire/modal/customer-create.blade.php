<x-modal.wrapper size="xl">
    <x-slot name="title">Create Customer</x-slot>
    <x-slot name="subtitle">All fields marked with
        <span class="text-red-500">*</span>
        is mandatory!
    </x-slot>
    <x-slot name="content">
        <form wire:submit="save()">
            <x-form.wrapper>
                <x-form.label for="name">Customer Name</x-form.label>
                <x-form.input id="name" type="text" wire:model="form.name" required placeholder="Full Name"/>
                @error('form.name')
                <x-alert negative :title="$message"/>
                @enderror
            </x-form.wrapper>
            <x-form.wrapper>
                <x-form.label for="phone_number">Phone Number</x-form.label>
                <x-form.input id="phone_number" type="text" wire:model="form.phoneNumber" required
                              placeholder="Phone Number"/>
                @error('form.phoneNumber')
                <x-alert negative :title="$message"/>
                @enderror
            </x-form.wrapper>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-modal.generic-footer/>
    </x-slot>
</x-modal.wrapper>
