{{--generic footer for save and cancel for any modal--}}
<div class="flex justify-start gap-4">
    <x-button emerald lg class="font-bold" wire:click="save()">Save</x-button>
    <x-button rose lg class="font-bold" @click="$wire.dispatch('modal-close')">Cancel</x-button>
</div>
