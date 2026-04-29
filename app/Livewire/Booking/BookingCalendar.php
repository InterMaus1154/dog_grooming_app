<?php

namespace App\Livewire\Booking;

use Illuminate\View\View;
use Livewire\Component;

class BookingCalendar extends Component
{
    public function getEvents(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Max - Full Groom',
                'start' => now()->toDateTimeString(),
                'color' => '#e11d48',
            ],
            [
                'id' => 2,
                'title' => 'Bella - Nail Trim',
                'start' => now()->addDays(2)->toDateTimeString(),
                'color' => '#e11d48',
            ],
            [
                'id' => 3,
                'title' => 'Charlie - Bath',
                'start' => now()->addDays(5)->toDateTimeString(),
                'color' => '#e11d48',
            ],
        ];
    }


    public function render(): View
    {
        return view('livewire.booking.booking-calendar', [
            'events' => $this->getEvents()
        ]);
    }
}
