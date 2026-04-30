<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class BookingCalendar extends Component
{

    public function render(): View
    {
        return view('livewire.booking.booking-calendar');
    }
}
