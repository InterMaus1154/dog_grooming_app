<div class="space-y-4">

    {{--filters--}}
    <form wire:submit.prevent class="md:w-[30%] space-y-2 flex items-center justify-center gap-2">
        <x-form.input type="text" placeholder="Search by name or phone..." wire:model.live.debounce.300ms="filters.search"/>
        <x-button class="bg-brand!" wire:click="clearFilters()">Reset</x-button>
    </form>
    <div class="text-sm text-brand-dark whitespace-nowrap">
            @if(!empty($filters['name']))
            Found: {{$customers->total()}}
        @endif
    </div>
    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th sortField="name">Name</x-table.th>
            <x-table.th sortField="phone_number">Phone Number</x-table.th>
            <x-table.th>Actions</x-table.th>
        </x-slot>
        <x-slot>
            @foreach($customers as $customer)
                <x-table.row wire:key="customer--{{$customer->id}}">
                    <x-table.cell>{{$customers->firstItem() + $loop->index}}</x-table.cell>
                    <x-table.cell>{{$customer->name}}</x-table.cell>
                    <x-table.cell>{{$customer->phone_number}}</x-table.cell> {{--TODO: make it callable--}}
                    <x-table.cell></x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$customers"/>
        </x-slot>
    </x-table>
</div>
