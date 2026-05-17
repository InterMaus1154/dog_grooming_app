{{--generic footer for save and cancel for any modal--}}

@php
    $formId = null;
    if(isset($__livewire)){
        $formId = $__livewire->getId();
    }
@endphp
<div class="flex justify-start gap-4">
    <x-button emerald light lg class="text-black!" icon="check-circle" wire:click="save()" form="form-{{$formId}}" type="submit">Save</x-button>
    <x-button rose light lg class="text-black!" icon="x-circle" @click="$wire.dispatch('modal-close')">Cancel</x-button>
</div>
