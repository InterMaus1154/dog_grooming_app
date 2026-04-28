<?php

namespace App\Livewire\Modal;

use Illuminate\View\View;
use Livewire\Component;

class Confirm extends Component
{

    public string $message = '';
    public string $event = '';
    public array $eventData = [];

    public function confirm(): void
    {
        $this->dispatch($this->event, ...$this->eventData);
        $this->dispatch('modal-clear');
    }

    public function cancel(): void
    {
        $this->dispatch('modal-close');
    }

    public function render(): View
    {
        return view('livewire.modal.confirm');
    }
}
