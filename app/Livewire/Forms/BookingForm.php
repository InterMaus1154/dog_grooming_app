<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    #[Validate('required')]
    public $dateTime = '';

    #[Validate('required|exists:dogs,id')]
    public $dogId = '';

    #[Validate('nullable|string')]
    public $notes = '';

    #[Validate('nullable|string')]
    public $treatment = '';

    #[Validate('nullable|numeric|min:0')]
    public $amount = null;
}
