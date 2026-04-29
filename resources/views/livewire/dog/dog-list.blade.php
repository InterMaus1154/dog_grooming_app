@php use App\Models\Dog; @endphp
<div class="space-y-4">
    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th sortField="name">Dog Name</x-table.th>
            <x-table.th sortField="breed_id">Breed</x-table.th>
            <x-table.th sortField="customer_id">Owner</x-table.th>
            <x-table.th>Last Visit</x-table.th>
            <x-table.th>Total Bookings</x-table.th>
            <x-table.th>Actions</x-table.th>
        </x-slot>
        <x-slot>
            @php/**@var Dog $dog */ @endphp
            @foreach($dogs as $dog)
                <x-table.row>
                    <x-table.cell>{{$dogs->firstItem() + $loop->index}}</x-table.cell>
                    <x-table.cell>{{$dog->name}}</x-table.cell>
                    <x-table.cell>{{$dog->dogBreed->name}}</x-table.cell>
                    <x-table.cell>{{$dog->customer->name}}</x-table.cell>
                    <x-table.cell>{{$dog->latestBooking ? $dog->latestBooking->scheduled_at : 'N/A'}}</x-table.cell>
                    <x-table.cell>{{$dog->bookings_count}}</x-table.cell>
                    <x-table.cell>
                        <div class="gap-4 hidden md:flex">
                            <x-button light md teal label="Details" icon="eye"></x-button>
                            <x-button light md info label="Edit" icon="pencil"
                                      @click="$dispatch('modal-open', {component: 'modal.dog-edit', componentData:{ id: {{$dog->id}} }  })"/>
                            <x-button light md orange label="Delete" icon="trash" wire:click="deleteDog({{$dog}})"/>
                        </div>
                        <div class="gap-4 flex md:hidden">
                            <x-button light md teal icon="eye" class="text-black!"></x-button>
                            <x-button light md info icon="pencil" class="text-black!"
                                      @click="$dispatch('modal-open', {component: 'modal.dog-edit', componentData:{ id: {{$dog->id}} }  })"/>
                            <x-button light md orange icon="trash" wire:click="deleteDog({{$dog}})"
                                      class="text-black!"/>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$dogs"/>
        </x-slot>
    </x-table>
</div>
