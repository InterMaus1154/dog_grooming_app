{{--generic footer for save and cancel for any modal--}}
<div class="flex justify-start gap-4">
    <x-button emerald light lg class="text-black!" icon="check-circle" wire:click="save()">Save</x-button>
    <x-button rose light lg class="text-black!" icon="x-circle" @click="$wire.dispatch('modal-close')">Cancel</x-button>
</div>
