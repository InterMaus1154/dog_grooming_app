<x-modal.wrapper size="5xl">
    <x-slot name="title">{{$dog->name}} ({{$dog->dogBreed->name}})</x-slot>
    <x-slot name="content">
        <div class="flex flex-col gap-4 bg-neutral-50  rounded-md p-4 shadow-md">
            <div class="flex flex-wrap gap-4 justify-between w-full ">
                <hgroup>
                    <h2 class="text-xl font-bold">Owner:</h2>
                    <p>{{$dog->customer->name}}</p>
                </hgroup>
                <hgroup>
                    <h2 class="text-xl font-bold">Phone Number:</h2>
                    <p>
                        <x-icon name="phone" class="inline size-5 text-brand-dark"/>
                        <a class="underline"
                           href="tel:{{$dog->customer->phone_number}}">{{$dog->customer->phone_number}}</a>
                    </p>
                </hgroup>
                <hgroup>
                    <h2 class="text-xl font-bold">Total Bookings:</h2>
                    <p>{{$dog->bookings_count}}</p>
                </hgroup>
            </div>
            <hgroup>
                <h2 class="text-xl font-bold">Notes:</h2>
                <p>{!! $this->dog->notes_br !!}</p>
            </hgroup>
        </div>
        <div class="my-8 flex flex-col gap-4 w-full bg-neutral-50 rounded-md p-4 shadow-md">
            <h2 class="text-2xl italic text-brand-dark">Upcoming Booking:</h2>
            @if(!$upcomingBooking)
                <i>No upcoming booking!</i>
            @else
                <div class="flex flex-wrap flex-col gap-4">
                    <hgroup>
                        <h2 class="text-lg font-bold">Date & time:</h2>
                        <p>{{$upcomingBooking->scheduled_at->format('l d/m/Y')}}
                            , {{$upcomingBooking->scheduled_at->format('H:i')}}
                            - {{$upcomingBooking->ends_at->format('H:i')}}</p>
                    </hgroup>
                    <hgroup>
                        <h2 class="text-lg font-bold">Notes:</h2>
                        <p>{!! nl2br(e($upcomingBooking->notes)) !!}</p>
                    </hgroup>
                    <hgroup>
                        <h2 class="text-lg font-bold">Treatment:</h2>
                        <p>{!! nl2br(e($upcomingBooking->treatment)) !!}</p>
                    </hgroup>
                    <hgroup>
                        <h2 class="text-lg font-bold">Amount:</h2>
                        <p>£{{number_format($upcomingBooking->amount)}}</p>
                    </hgroup>
                </div>
            @endif
        </div>
        <div class="my-8 flex flex-col gap-4 w-full bg-neutral-50  rounded-md p-4 shadow-md">
            <h2 class="text-2xl italic text-brand-dark">Previous Booking:</h2>
            @if(!$previousBooking)
                <i>No previous booking!</i>
            @else
                <div class="flex flex-wrap flex-col gap-4">
                    <hgroup>
                        <h2 class="text-lg font-bold">Date & time:</h2>
                        <p>{{$previousBooking->scheduled_at->format('l d/m/Y')}}
                            , {{$previousBooking->scheduled_at->format('H:i')}}
                            - {{$previousBooking->ends_at->format('H:i')}}</p>
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
        <div class="flex gap-4 flex-wrap">
            <x-button light teal lg icon="plus-circle" label="Add Booking" class="text-black!"
                      @click="$dispatch('modal-open', {component: 'modal.booking-create', componentData: { dogId: {{$dog->id}} }})"/>
            <x-button light lg info icon="pencil" label="Edit" class="text-black!"
                      @click="$dispatch('modal-open', {component: 'modal.dog-edit', componentData: { id: {{$dog->id}} }})"/>
            <x-button light rose lg icon="x-circle" label="Close" class="text-black!"
                      @click="$dispatch('modal-close')"/>
        </div>
    </x-slot>
</x-modal.wrapper>
