@props(['sortField' => null])

@php
    // in a livewire component, when the field we are sorting by is the same as its name
    $active = isset($sortField) && isset($__livewire) && $__livewire->sortField == $sortField;
@endphp

<th class="px-6 py-3 text-lg md:text-xl text-brand-dark {{$active ? 'italic' : ''}}  {{ $sortField ? 'cursor-pointer hover:text-brand select-none' : '' }}"
    @if($sortField) wire:click="setSort('{{ $sortField }}')" @endif>
    <div class="flex items-center gap-1">
        {{ $slot }}
        @if($sortField)
            @if($active)
                @if($__livewire->sortDirection == 'asc')
                    <x-heroicon-s-chevron-up class="w-6 h-6"/>
                @else
                    <x-heroicon-s-chevron-down class="w-6 h-6"/>
                @endif
            @else
                <x-heroicon-s-chevron-up-down class="w-6 h-6"/>
            @endif
        @endif
    </div>
</th>
