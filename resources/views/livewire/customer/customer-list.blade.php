<div class="space-y-4">

    {{--filters--}}
    <form wire:submit.prevent class="md:w-[30%] space-y-2 flex items-center justify-center gap-2">
        <x-form.input type="text" placeholder="Search by name or phone..."
                      wire:model.live.debounce.300ms="filters.search"/>
        <x-button class="bg-brand!" wire:click="clearFilters()">Reset</x-button>
    </form>
    <div class="text-sm text-brand-dark whitespace-nowrap">
        @if(!empty($filters['search']))
            Found: {{$customers->total()}}
        @endif
    </div>
    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th sortField="name">Name</x-table.th>
            <x-table.th sortField="phone_number">Phone Number</x-table.th>
            <x-table.th>Bookings</x-table.th>
            <x-table.th>Dogs</x-table.th>
            <x-table.th>Actions</x-table.th>
        </x-slot>
        <x-slot>
            @foreach($customers as $customer)
                <x-table.row wire:key="customer--{{$customer->id}}">
                    <x-table.cell>{{$customers->firstItem() + $loop->index}}</x-table.cell>
                    <x-table.cell>{{$customer->name}}</x-table.cell>
                    <x-table.cell class="whitespace-nowrap">
                        <div>
                            <x-icon name="phone" class="inline size-5 text-brand-dark"/>
                            <a class="underline" href="tel:{{$customer->phone_number}}">{{$customer->phone_number}}</a>
                        </div>
                    </x-table.cell>
                    <x-table.cell>{{$customer->bookings_count}}</x-table.cell>
                    <x-table.cell>{{$customer->dogs_count}}</x-table.cell>
                    <x-table.cell>
                        <div class="gap-4 hidden md:flex">
                            <x-button light md teal label="Details" icon="eye"></x-button>
                            <x-button light md info label="Edit" icon="pencil"
                                      @click="$dispatch('modal-open', {component: 'modal.customer-edit', componentData:{ id: {{$customer->id}} }  })"/>
                            <x-button light md orange label="Delete" icon="trash" wire:click="deleteCustomer({{$customer}})"/>
                        </div>
                        <div class="gap-4 flex md:hidden">
                            <x-button light md teal icon="eye" class="text-black!"></x-button>
                            <x-button light md info icon="pencil" class="text-black!"
                                      @click="$dispatch('modal-open', {component: 'modal.customer-edit', componentData:{ id: {{$customer->id}} }  })"/>
                            <x-button light md orange icon="trash" wire:click="deleteCustomer({{$customer}})"
                                      class="text-black!"/>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$customers"/>
        </x-slot>
    </x-table>
</div>
