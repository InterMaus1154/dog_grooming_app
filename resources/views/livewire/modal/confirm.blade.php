<x-modal.wrapper size="md">
    <x-slot name="title">Are you sure?</x-slot>
    <x-slot name="subtitle">{{$message}}</x-slot>
    <x-slot name="footer">
        <div class="flex gap-2">
            <x-button icon="check" light warning lg wire:click="confirm()" class="text-black!">Confirm</x-button>
            <x-button icon="x-circle" light negative lg wire:click="cancel()" class="text-black!">Cancel</x-button>
        </div>
    </x-slot>
</x-modal.wrapper>
