<?php

namespace App\Livewire\Modal;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class BookingShow extends Component
{

    use WireUiActions;

    public Booking $booking;

    public function mount(int $bookingId): void
    {
        $this->booking = Booking::with('dog.customer')->findOrFail($bookingId);
    }

    public function deleteBooking(Booking $booking): void
    {
        $booking->loadMissing('dog');
        $this->dispatch('modal-open', 'modal.confirm', [
            'message' => sprintf('This will delete booking for %s on %s', $booking->dog->name, $booking->scheduled_at->format('H:i, l d/m/y')),
            'event' => 'delete-booking',
            'eventData' => [$booking]
        ]);
    }

    #[On('delete-booking')]
    public function deleteBookingEventReceiver(Booking $booking): void
    {
        $booking->delete();
        $this->notification()->success('Booking has been deleted');
        $this->dispatch('modal-close');
        $this->dispatch('refresh-bookings');
    }

    public function render(): View
    {
        $startTime = Carbon::parse($this->booking->scheduled_at)->format('H:i');
        $endTime = Carbon::parse($this->booking->ends_at)->format('H:i');
        $prettyDate = Carbon::parse($this->booking->scheduled_at)->format('l d/m/Y');
        return view('livewire.modal.booking-show', compact('startTime', 'endTime', 'prettyDate'));
    }
}
