@props(['paginator'])

@if($paginator->hasPages())
    @php
        $currentPage = $paginator->currentPage();
        $lastPage = $paginator->lastPage();
        $window = 2;

        $start = max(1, $currentPage - $window);
        $end = min($lastPage, $currentPage + $window);
    @endphp

    <div class="flex items-center justify-between px-4 py-3 border-t border-brand-dark">
        <p class="text-sm text-brand-dark">
            Showing {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }} of {{ $paginator->total() }}
        </p>

        <div class="flex gap-1 items-center">
            {{-- Previous --}}
            <button
                wire:click="previousPage"
                @if($paginator->onFirstPage()) disabled @endif
                class="p-1 rounded-md text-brand-dark hover:bg-rose-100 disabled:opacity-30 disabled:cursor-not-allowed cursor-pointer">
                <x-heroicon-s-chevron-left class="w-4 h-4"/>
            </button>

            {{-- First page + ellipsis --}}
            @if($start > 1)
                <button wire:click="gotoPage(1)" class="px-3 py-1 rounded-md text-sm text-brand-dark hover:bg-rose-100 cursor-pointer">1</button>
                @if($start > 2)
                    <span class="px-2 text-brand-dark">...</span>
                @endif
            @endif

            {{-- Window --}}
            @for($page = $start; $page <= $end; $page++)
                @if($page === $currentPage)
                    <span class="px-3 py-1 rounded-md text-sm bg-brand text-white font-bold">{{ $page }}</span>
                @else
                    <button wire:click="gotoPage({{ $page }})" class="px-3 py-1 rounded-md text-sm text-brand-dark hover:bg-rose-100 cursor-pointer">{{ $page }}</button>
                @endif
            @endfor

            {{-- Last page + ellipsis --}}
            @if($end < $lastPage)
                @if($end < $lastPage - 1)
                    <span class="px-2 text-brand-dark">...</span>
                @endif
                <button wire:click="gotoPage({{ $lastPage }})" class="px-3 py-1 rounded-md text-sm text-brand-dark hover:bg-rose-100 cursor-pointer">{{ $lastPage }}</button>
            @endif

            {{-- Next --}}
            <button
                wire:click="nextPage"
                @if(!$paginator->hasMorePages()) disabled @endif
                class="p-1 rounded-md text-brand-dark hover:bg-rose-100 disabled:opacity-30 disabled:cursor-not-allowed cursor-pointer">
                <x-heroicon-s-chevron-right class="w-4 h-4"/>
            </button>
        </div>
    </div>
@endif
