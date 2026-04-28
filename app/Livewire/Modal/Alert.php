<?php

namespace App\Livewire\Modal;

use Illuminate\View\View;
use Livewire\Component;

class Alert extends Component
{
    public string $title = '';
    public string $message = '';
    public string $heroIcon = 'exclamation-circle'; // only valid heroicon is accepted

    public function render(): View
    {
        return view('livewire.modal.alert');
    }
}
