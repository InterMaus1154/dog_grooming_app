<?php

namespace App\Livewire\Forms;

use Carbon\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\ValidationException;

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

    #[Validate('required')]
    public $endsTime = ''; // (end time of the booking)

    public function validateEndsTime(): void
    {
        $start = Carbon::parse($this->dateTime);
        $end = Carbon::parse($this->dateTime)->setTimeFromTimeString($this->endsTime);

        if ($end->lessThan($start)) {
            throw ValidationException::withMessages([
                'form.endsTime' => 'End time must be after start'
            ]);
        }

    }

    public function validateAll(): void
    {
        $this->amount = trim($this->amount) ?: null; // empty strings could cause database errors, we switch to null instead
        $this->validate();
        $this->validateEndsTime();

    }
}
