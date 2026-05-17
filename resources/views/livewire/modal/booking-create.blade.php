<x-modal.wrapper size="4xl">
    <x-slot name="title">Add Booking</x-slot>
    <x-slot name="subtitle">All fields marked with
        <span class="text-red-500">*</span>
        are required!
    </x-slot>
    <x-slot name="content">
        <form id="form-{{$this->getId()}}" wire:submit="save()" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form.wrapper>
                    <x-form.label for="date">Date</x-form.label>
                    <x-form.input type="datetime-local" wire:model="form.dateTime" id="date" required/>
                    @error('form.date')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
                <x-form.wrapper>
                    <x-form.label for="ends_at">End Time</x-form.label>
                    <x-form.input type="time" wire:model="form.endsTime" required/>
                    @error('form.endsTime')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form.wrapper class="w-full">
                    <x-form.label for="dog_id" class="relative">Dog
                        <span class="text-red-500">*</span>
                        <x-mini-button class="absolute top-[-25%]" rounded icon="plus" flat rose
                                       @click="$dispatch('modal-open', {component: 'modal.dog-create'})"/>
                    </x-form.label>
                    <x-select searchable :options="$dogs" option-label="name" option-value="id" min-items-for-search="1"
                              wire:model="form.dogId"/>
                    @error('form.dogId')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
                <x-form.wrapper>
                    <x-label for="amount">£ Amount</x-label>
                    <x-form.input type="text" wire:model="form.amount" placeholder="Numbers Only"/>
                    @error('form.amount')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-form.wrapper>
                    <x-form.label for="notes">Notes</x-form.label>
                    <x-textarea id="notes"
                                placeholder="(Optional)"
                                wire:model="form.notes"/>
                </x-form.wrapper>
                <x-form.wrapper>
                    <x-form.label for="treatment">Treatment</x-form.label>
                    <x-textarea id="treatment" placeholder="(Optional)"
                                wire:model="form.treatment"/>
                </x-form.wrapper>
            </div>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-modal.generic-footer/>
    </x-slot>
</x-modal.wrapper>
