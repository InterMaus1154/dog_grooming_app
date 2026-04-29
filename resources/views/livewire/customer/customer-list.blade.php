<div class="space-y-4">

    {{--filters--}}
    <form wire:submit.prevent class="md:w-[30%] space-y-2 flex items-center justify-center gap-2">
        <x-form.input type="text" placeholder="Search by name..." wire:model.live.debounce.300ms="filters.name"/>
        <x-button class="bg-brand!" wire:click="clearFilters()">Reset</x-button>
        <span class="text-sm text-brand-dark whitespace-nowrap">
            @if(!empty($filters['name']))
                Found:
            @endif
        </span>
    </form>

    <x-table>
        <x-slot name="headers">
            <x-table.th>#</x-table.th>
            <x-table.th>Name</x-table.th>
            <x-table.th>Name</x-table.th>
        </x-slot>
    </x-table>
</div>
