<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\BookingForm;
use App\Models\Booking;
use App\Models\Dog;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class BookingEdit extends Component
{
    use WireUiActions;

    public Booking $booking;
    public BookingForm $form;

    public function mount(int $id): void
    {
        $this->booking = Booking::with('dog')->findOrFail($id);
        $this->form->dogId = $this->booking->dog_id;
        $this->form->treatment = $this->booking->treatment;
        $this->form->notes = $this->booking->notes;
        $this->form->dateTime = $this->booking->scheduled_at->format('Y-m-d\TH:i');
        $this->form->endsTime = $this->booking->ends_at->format('H:i');
        $this->form->amount = $this->booking->amount;
    }

    public function save(): void
    {
        $this->form->validateAll();

        try {
            $this->booking->update([
                'dog_id' => $this->form->dogId,
                'scheduled_at' => Carbon::parse($this->form->dateTime),
                'amount' => $this->form->amount,
                'notes' => $this->form->notes,
                'treatment' => $this->form->treatment,
                'ends_at' => Carbon::parse($this->form->dateTime)->setTimeFromTimeString($this->form->endsTime)
            ]);

            $this->notification()->success('Successfully updated booking');
        } catch (\Exception $e) {
            $this->notification()->error('Error at updating booking. Contact your administrator');
            activity('booking')
                ->withProperties(['error' => $e->getMessage()])
                ->log('Error at updating a booking record');
        }

        $this->dispatch('modal-close');
        $this->dispatch('refresh-bookings');

    }

    public function render(): View
    {
        $dogs = Dog::all();
        return view('livewire.modal.booking-edit', compact('dogs'));
    }
}
