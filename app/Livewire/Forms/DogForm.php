<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class DogForm extends Form
{
    #[Validate('required|exists:customers,id')]
    public $customerId = '';

    #[Validate('required|exists:dog_breeds,id')]
    public $breedId = '';

    #[Validate('required|string|min:2|max:50')]
    public string $name = '';

    #[Validate('nullable|string')]
    public ?string $notes = null;


    public function validateAll(): void
    {
        $this->notes = trim($this->notes);
        $this->name = trim($this->name);

        $this->validate();
    }
}
