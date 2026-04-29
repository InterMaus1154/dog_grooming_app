<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class CustomerForm extends Form
{
    #[Validate('required|string|min:2|max:200')]
    public string $name = '';

    #[Validate('required|string|min:2|max:20')]
    public string $phoneNumber = '';
}
