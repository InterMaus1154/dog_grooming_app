<?php

namespace App\Livewire\Modal;

use App\Enums\LivewireEvent;
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
        $this->booking = Booking::with(['dog.customer', 'dog.dogBreed'])->findOrFail($bookingId);
    }

    public function deleteBooking(): void
    {
        $this->dispatch(LivewireEvent::MODAL_OPEN->value, 'modal.confirm', [
            'message' => sprintf('This will delete booking for %s on %s', $this->booking->getTitle(), $this->booking->scheduled_at->format('H:i, l d/m/y')),
            'event' => LivewireEvent::DELETE_BOOKING->value,
            'eventData' => [$this->booking->id]
        ]);
    }

    #[On(LivewireEvent::DELETE_BOOKING->value)]
    public function deleteBookingEventReceiver(int $id): void
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        $this->notification()->success('Booking has been deleted');
        $this->dispatch(LivewireEvent::MODAL_CLOSE->value);
        $this->dispatch(LivewireEvent::REFRESH_BOOKINGS->value);
    }

    #[On(LivewireEvent::REFRESH_DOGS->value)]
    #[On(LivewireEvent::REFRESH_BOOKINGS->value)]
    public function actionOnBookingRefresh(): void
    {
    }

    public function render(): View
    {
        $startTime = $this->booking->scheduled_at->format('H:i');
        $endTime = $this->booking->ends_at->format('H:i');
        $prettyDate = $this->booking->scheduled_at->format('l d/m/Y');

        $previousBooking = Booking::query()
            ->where('dog_id', $this->booking->dog_id)
            ->whereDate('scheduled_at', '<', $this->booking->scheduled_at)
            ->latest('scheduled_at')
            ->first();

        return view('livewire.modal.booking-show', compact('startTime', 'endTime', 'prettyDate', 'previousBooking'));
    }
}
