<x-modal.wrapper>
    <x-slot name="title">
        {{$booking->dog->name}}, {{$prettyDate}} {{$startTime}} - {{$endTime}}
    </x-slot>
    <x-slot name="footer">
        <div class="flex gap-4 justify-start">
            <x-button light info lg icon="pencil" class="text-black!">Edit</x-button>
            <x-button light orange lg icon="trash" class="text-black!" wire:click="deleteBooking({{$booking}})">
                Delete
            </x-button>
            <x-button light rose lg icon="x-circle" class="text-black!" @click="$dispatch('modal-close')">Close
            </x-button>
        </div>
    </x-slot>
</x-modal.wrapper>
