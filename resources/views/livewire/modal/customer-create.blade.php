<x-modal.wrapper>
    <x-slot name="title">Create Customer</x-slot>
    <x-slot name="subtitle">All fields marked with <span class="text-red-500">*</span> is mandatory!</x-slot>
    <x-slot name="content">

    </x-slot>
    <x-slot name="footer">
        <div class="flex justify-start gap-4">
            <x-button emerald lg class="font-bold">Save</x-button>
            <x-button rose lg class="font-bold" @click="$wire.dispatch('modal-clear')">Cancel</x-button>
        </div>
    </x-slot>
</x-modal.wrapper>
