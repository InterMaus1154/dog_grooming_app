<x-modal.wrapper size="lg">
    <x-slot name="title">Add new dog</x-slot>
    <x-slot name="subtitle">All fields marked with
        <span class="text-red-500">*</span>
        is mandatory!
    </x-slot>
    <x-slot name="content">
        <form wire:submit="save()">
            <div class="flex gap-4">
                <x-form.wrapper class="w-full">
                    <x-form.label for="customer_id" class="relative">Customer
                        <span class="text-red-500">*</span>
                        <x-mini-button class="absolute top-[-25%]" rounded icon="plus" flat rose
                                       @click="$dispatch('modal-open', {component: 'modal.customer-create'})"/>
                    </x-form.label>
                    <x-select id="customer_id" placeholder="Select a customer" :min-items-for-search="0"
                              :options="$customers" option-label="name" option-value="id"
                              wire:model="form.customerId" empty-message="No customer found!"></x-select>
                    @error('form.customerId')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
                <x-form.wrapper class="w-full">
                    <x-form.label for="breed_id" class="relative">Breed
                        <span class="text-red-500">*</span>
                        <x-mini-button class="absolute top-[-25%]" rounded icon="plus" flat rose
                                       @click="$dispatch('modal-open', {component: 'modal.dog-breed-create'})"/>
                    </x-form.label>
                    <x-select id="breed_id" placeholder="Select a breed" :min-items-for-search="0"
                              :options="$breeds" option-label="name" option-value="id"
                              empty-message="No breed found!" wire:model="form.breedId"></x-select>
                    @error('form.breedId')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
            </div>
            <x-form.wrapper>
                <x-form.label for="name">Dog Name</x-form.label>
                <x-form.input type="text" placeholder="Dog Name" wire:model="form.name" required/>
                @error('form.name')
                <x-alert negative>{{$message}}</x-alert>
                @enderror
            </x-form.wrapper>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-modal.generic-footer/>
    </x-slot>
</x-modal.wrapper>
