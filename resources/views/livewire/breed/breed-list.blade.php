<div class="space-y-4">
    {{--filters--}}
    <form wire:submit.prevent class="w-max md:w-[25%] space-y-2 flex items-center justify-center gap-2 ">
        <x-form.input type="text" placeholder="Search by name..." wire:model.live.debounce="filters.name"/>
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
                    <x-table.cell>
                        <div class="gap-4 hidden md:flex">
                            <x-button light md teal label="Details" icon="eye"></x-button>
                            <x-button light md info label="Edit" icon="pencil"
                                      @click="$dispatch('modal-open', {component: 'modal.dog-breed-edit', componentData:{ id: {{$breed->id}} }  })"/>
                            <x-button light md orange label="Delete" icon="trash" wire:click="deleteBreed({{$breed}})"/>
                        </div>
                        <div class="gap-4 flex md:hidden">
                            <x-button light md teal icon="eye"></x-button>
                            <x-button light md info icon="pencil"
                                      @click="$dispatch('modal-open', {component: 'modal.dog-breed-edit', componentData:{ id: {{$breed->id}} }  })"/>
                            <x-button light md orange icon="trash" wire:click="deleteBreed({{$breed}})"/>
                        </div>
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$breeds"/>
        </x-slot>
    </x-table>
</div>
