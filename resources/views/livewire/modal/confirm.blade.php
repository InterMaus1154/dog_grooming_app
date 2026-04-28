<x-modal.wrapper size="md">
    <x-slot name="title">Are you sure?</x-slot>
    <x-slot name="subtitle">{{$message}}</x-slot>
    <x-slot name="footer">
        <div class="flex gap-2">
            <x-button warning lg wire:click="confirm()">Confirm</x-button>
            <x-button negative lg wire:click="cancel()">Cancel</x-button>
        </div>
    </x-slot>
</x-modal.wrapper>
