<div class="space-y-4">
    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th sortField="custom:dog_name">Dog Name</x-table.th>
            <x-table.th class="w-min" sortField="custom:customer_name">Customer Name</x-table.th>
            <x-table.th>Status</x-table.th>
            <x-table.th sortField="scheduled_at">Scheduled At</x-table.th>
            <x-table.th sortfield="created_at">Booked At</x-table.th>
            <x-table.th class="w-fit">Actions</x-table.th>
        </x-slot>
        <x-slot>
            @foreach($bookings as $booking)
                <x-table.row>
                    <x-table.cell>{{$bookings->firstItem() + $loop->index}}</x-table.cell>
                    <x-table.cell>{{$booking->dog->name}} ({{$booking->dog->dogBreed->name}})</x-table.cell>
                    <x-table.cell>{{$booking->customer->name}}</x-table.cell>
                    <x-table.cell>
                        <x-badge lg :color="$booking->status->getBadgeColor()" label="{{$booking->status->getName()}}"/>
                    </x-table.cell>
                    <x-table.cell class="whitespace-nowrap">{{prettyDateTimeString($booking->scheduled_at)}} - {{prettyTimeFromDateString($booking->ends_at)}}</x-table.cell>
                    <x-table.cell>{{$booking->created_at->format('d/m/Y')}}</x-table.cell>
                    <x-table.cell>
                        <div class="flex gap-4 flex-nowrap whitespace-nowrap">
                            <x-button light teal lg icon="eye" class="text-black!" @click="$dispatch('modal-open', {component: 'modal.booking-show', componentData: {bookingId: {{$booking->id}} }})">Details</x-button>
                            <x-button light info lg icon="pencil" class="text-black!"
                                      @click="$dispatch('modal-open', {component: 'modal.booking-edit', componentData: { id: {{$booking->id}} }})">
                                Edit
                            </x-button>
                            <x-button light orange lg icon="trash" class="text-black!" wire:click="deleteBooking({{$booking}})">
                                Delete
                            </x-button>
                            <x-button light rose lg icon="x-circle" class="text-black!" @click="$dispatch('modal-close')">Close
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
