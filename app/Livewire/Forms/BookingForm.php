<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class BookingForm extends Form
{
    #[Validate('required')]
    public $dateTime = ''; // start time of the booking (booked at on that time)

    #[Validate('required|exists:dogs,id')]
    public $dogId = '';

    #[Validate('nullable|string')]
    public $notes = '';

    #[Validate('nullable|string')]
    public $treatment = '';

    #[Validate('nullable|numeric|min:0')]
    public $amount = null;

    #[Validate('nullable|required|after_or_equal:dateTime')]
    public $endsTime = ''; // (end time of the booking)
}
