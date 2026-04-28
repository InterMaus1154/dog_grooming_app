<x-modal.wrapper size="lg">
    <x-slot name="title">Edit '{{$breed->name}}'</x-slot>
    <x-slot name="subtitle">All fields marked with
        <span class="text-red-500">*</span>
        is mandatory!
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent wire:submit="save()">
            <x-form.wrapper>
                <x-form.label>Breed Name</x-form.label>
                <x-form.input type="text" placeholder="Breed Name" required wire:model="form.name"/>
                @error('form.name')
                <x-alert negative :title="$message"/>
                @enderror
            </x-form.wrapper>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-modal.generic-footer/>
    </x-slot>
</x-modal.wrapper>
