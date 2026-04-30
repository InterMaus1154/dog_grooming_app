<x-modal.wrapper size="4xl">
    <x-slot name="title">Add Booking</x-slot>
    <x-slot name="subtitle">All fields marked with
        <span class="text-red-500">*</span>
        are required!
    </x-slot>
    <x-slot name="content">
        <form wire:submit="save()" class="space-y-4">
            <div class="flex gap-4">
                <x-form.wrapper class="w-[50%]">
                    <x-form.label for="date">Date</x-form.label>
                    <x-form.input type="datetime-local" wire:model="form.dateTime" id="date" required/>
                    @error('form.date')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
                <x-form.wrapper class="flex-1">
                    <x-form.label for="dog_id" class="relative">Dog
                        <span class="text-red-500">*</span>
                        <x-mini-button class="absolute top-[-25%]" rounded icon="plus" flat rose
                                       @click="$dispatch('modal-open', {component: 'modal.dog-create'})"/>
                    </x-form.label>
                    <x-select searchable :options="$dogs" option-label="name" option-value="id" min-items-for-search="1" wire:model="form.dogId"/>
                    @error('form.dogId')
                    <x-alert negative>{{$message}}</x-alert>
                    @enderror
                </x-form.wrapper>
            </div>
            <div class="flex gap-4">
                <x-form.wrapper class="w-[50%]">
                    <x-form.label for="notes" >Notes</x-form.label>
                    <x-textarea id="notes" placeholder="Any notes from the customer or things that are useful (optional)" wire:model="form.notes"/>
                </x-form.wrapper>
                <x-form.wrapper class="w-[50%]">
                    <x-form.label for="treatment" >Treatment</x-form.label>
                    <x-textarea id="treatment" placeholder="Details about treatment for the dog (optional)" wire:model="form.treatment"/>
                </x-form.wrapper>
            </div>
            <x-form.wrapper>
                <x-label for="amount">£ Amount</x-label>
                <x-form.input type="text" wire:model="form.amount" placeholder="£"/>
                @error('form.amount')
                    <x-alert negative>{{$message}}</x-alert>
                @enderror
            </x-form.wrapper>
        </form>
    </x-slot>
    <x-slot name="footer">
        <x-modal.generic-footer/>
    </x-slot>
</x-modal.wrapper>
