<div class="space-y-4">
    {{--filters--}}
    <form wire:submit.prevent class="w-max space-y-2">
        <x-form.wrapper>
            <x-form.input type="text" placeholder="Search by name..." wire:model.live.debounce="filters.name"/>
        </x-form.wrapper>
        <x-button class="bg-brand!" wire:click="clearFilters()">Reset</x-button>
    </form>

    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th sortField="name">Name</x-table.th>
            <x-table.th sortField="custom:dog-count">Dogs in Breed</x-table.th>
            <x-table.th>Actions</x-table.th>
        </x-slot>
        <x-slot>
            @foreach($breeds as $breed)
                <x-table.row>
                    <x-table.cell>{{$breeds->firstItem() + $loop->index}}</x-table.cell>
                    <x-table.cell>{{$breed->name}}</x-table.cell>
                    <x-table.cell>{{$breed->dogs_count}}</x-table.cell>
                    <x-table.cell></x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$breeds"/>
        </x-slot>
    </x-table>
</div>
