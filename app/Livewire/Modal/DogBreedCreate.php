<?php

namespace App\Livewire\Modal;

use Livewire\Component;

class DogBreedCreate extends Component
{

    public function save(): void
    {
        dump("saved");
    }

    public function render()
    {
        return view('livewire.modal.dog-breed-create');
    }
}
