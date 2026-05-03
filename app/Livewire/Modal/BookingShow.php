<?php

namespace App\Livewire\Modal;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class BookingShow extends Component
{

    public Booking $booking;

    public function mount(int $bookingId): void
    {
        $this->booking = Booking::with('dog.customer')->findOrFail($bookingId);
    }

    public function render(): View
    {
        $startTime = Carbon::parse($this->booking->scheduled_at)->format('H:i');
        $endTime = Carbon::parse($this->booking->ends_at)->format('H:i');
        $prettyDate = Carbon::parse($this->booking->scheduled_at)->format('l, d/m/Y');
        return view('livewire.modal.booking-show', compact('startTime', 'endTime', 'prettyDate'));
    }
}
