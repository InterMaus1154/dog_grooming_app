<div class="space-y-4">

    <form wire:submit.prevent class="md:w-[30%] space-y-2 flex items-start flex-col justify-center gap-2">
        <x-form.input type="text" placeholder="Search by dog, customer name, or customer phone number.."
                      wire:model.live.debounce.300ms="filters.search"/>
        <div class="flex gap-4 flex-wrap">
            <x-form.wrapper>
                <x-form.label for="from">From</x-form.label>
                <x-form.input type="date" id="from" wire:model.live="filters.dateFrom"/>
            </x-form.wrapper>
            <x-form.wrapper>
                <x-form.label for="to">To</x-form.label>
                <x-form.input type="date" id="to" wire:model.live="filters.dateTo"/>
            </x-form.wrapper>
        </div>
    </form>
    <x-button class="bg-brand!" wire:click="clearFilters()">Reset</x-button>
    <div class="text-sm text-brand-dark whitespace-nowrap">
        @if(!empty($filters['search']))
            Found: {{$bookings->total()}}
        @endif
    </div>
    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th>Dog Name</x-table.th>
            <x-table.th class="w-min">Customer Name</x-table.th>
            <x-table.th>Status</x-table.th>
            <x-table.th sortField="scheduled_at">Scheduled At</x-table.th>
            <x-table.th sortField="created_at">Booked At</x-table.th>
            <x-table.th class="w-fit">Actions</x-table.th>
        </x-slot>
        <x-slot>
            @foreach($bookings as $booking)
                <x-table.row>
                    <x-table.cell>{{$bookings->firstItem() + $loop->index}}</x-table.cell>
                    <x-table.cell>
                        <span class="underline text-blue-500 cursor-pointer" tabindex="0"
                              @click="$dispatch('modal-open', {component: 'modal.dog-show', componentData: {id: {{$booking->dog_id}}}})"
                              @keyup.enter="$dispatch('modal-open', {component: 'modal.dog-show', componentData: {id: {{$booking->dog_id}}}})">{{$booking->dog->name}} ({{$booking->dog->dogBreed->name}})</span>
                    </x-table.cell>
                    <x-table.cell>{{$booking->customer->name}}</x-table.cell>
                    <x-table.cell>
                        <x-badge lg :color="$booking->status->getBadgeColor()" label="{{$booking->status->getName()}}"/>
                    </x-table.cell>
                    <x-table.cell class="whitespace-nowrap">{{prettyDateTimeString($booking->scheduled_at)}}
                        - {{prettyTimeFromDateString($booking->ends_at)}}</x-table.cell>
                    <x-table.cell>{{$booking->created_at->format('d/m/Y')}}</x-table.cell>
                    <x-table.cell>
                        <div class="flex gap-4 flex-nowrap whitespace-nowrap">
                            <x-button light teal lg icon="eye" class="text-black!"
                                      @click="$dispatch('modal-open', {component: 'modal.booking-show', componentData: {bookingId: {{$booking->id}} }})">
                                Details
                            </x-button>
                            <x-button light info lg icon="pencil" class="text-black!"
                                      @click="$dispatch('modal-open', {component: 'modal.booking-edit', componentData: { id: {{$booking->id}} }})">
                                Edit
                            </x-button>
                            <x-button light orange lg icon="trash" class="text-black!"
                                      wire:click="deleteBooking({{$booking}})">
                                Delete
                            </x-button>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$bookings"/>
        </x-slot>
    </x-table>
</div>
