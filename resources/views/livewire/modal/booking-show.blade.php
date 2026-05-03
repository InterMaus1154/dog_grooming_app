<x-modal.wrapper size="5xl">
    <x-slot name="title">
        {{$booking->dog->name}} ({{$booking->dog->dogBreed->name}}), {{$prettyDate}} {{$startTime}} - {{$endTime}}
    </x-slot>
    <x-slot name="content">
        <div class="flex justify-center my-4">
            <x-badge lg :color="$booking->status->getBadgeColor()" label="{{$booking->status->getName()}}"/>
        </div>
        <div class="flex flex-wrap md:grid grid-cols-3 gap-4">
            <hgroup>
                <h2 class="text-xl font-bold">Booking Notes:</h2>
                @if($booking->notes)
                    <p>{!! nl2br(e($booking->notes)) !!} </p>
                @else
                    <i>No notes yet!</i>
                @endif
            </hgroup>
            <hgroup>
                <h2 class="text-xl font-bold">Booking Treatment:</h2>
                @if($booking->treatment)
                    <p>{!! nl2br(e($booking->treatment)) !!} </p>
                @else
                    <i>No treatment yet!</i>
                @endif
            </hgroup>
            <hgroup>
                <h2 class="text-xl font-bold">Booking Amount:</h2>
                @if($booking->amount)
                    <p>£{{number_format($booking->amount, 2)}}</p>
                @else
                    <i>No amount yet!</i>
                @endif
            </hgroup>
        </div>
        <div class="my-8">
            <h2 class="text-2xl italic my-2">Previous visit details:</h2>
            @if(!$previousBooking)
                <i>No previous booking yet!</i>
            @else
                <div class="flex flex-wrap flex-col gap-4">
                    <hgroup>
                        <h2 class="text-lg font-bold">Date & time:</h2>
                        <p>{{$previousBooking->scheduled_at->format('l d/m/Y')}}, {{$previousBooking->scheduled_at->format('H:i')}} - {{$previousBooking->ends_at->format('H:i')}}</p>
                    </hgroup>
                    <hgroup>
                        <h2 class="text-lg font-bold">Notes:</h2>
                        <p>{!! nl2br(e($previousBooking->notes)) !!}</p>
                    </hgroup>
                    <hgroup>
                        <h2 class="text-lg font-bold">Treatment:</h2>
                        <p>{!! nl2br(e($previousBooking->treatment)) !!}</p>
                    </hgroup>
                    <hgroup>
                        <h2 class="text-lg font-bold">Amount:</h2>
                        <p>£{{number_format($previousBooking->amount)}}</p>
                    </hgroup>
                </div>
            @endif

        </div>
    </x-slot>
    <x-slot name="footer">
        <div class="flex gap-4 justify-start flex-wrap">
            <x-button light teal lg icon="eye" class="text-black!">Show Dog Details</x-button>
            <x-button light info lg icon="pencil" class="text-black!">Edit</x-button>
            <x-button light orange lg icon="trash" class="text-black!" wire:click="deleteBooking({{$booking}})">
                Delete
            </x-button>
            <x-button light rose lg icon="x-circle" class="text-black!" @click="$dispatch('modal-close')">Close
            </x-button>
        </div>
    </x-slot>

</x-modal.wrapper>
