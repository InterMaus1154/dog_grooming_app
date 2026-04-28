<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class DogBreedForm extends Form
{
    #[Validate('required|string|max:100|min:2')]
    public $name = '';
}
