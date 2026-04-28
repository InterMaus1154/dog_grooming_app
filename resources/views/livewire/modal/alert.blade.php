<x-modal.wrapper size="md">
    <x-slot name="title">
        <x-icon name="{{$heroIcon}}" class="w-8 h-8"/>
        {{$title}}
    </x-slot>
    <x-slot name="subtitle">{{$message}}</x-slot>
    <x-slot name="footer">
        <div class="flex justify-center">
            <x-button primary lg icon="check" @click="$dispatch('modal-clear')">OK</x-button>
        </div>
    </x-slot>
</x-modal.wrapper>
