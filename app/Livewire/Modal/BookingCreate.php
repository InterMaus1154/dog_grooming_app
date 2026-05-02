<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\BookingForm;
use App\Models\Booking;
use App\Models\Dog;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class BookingCreate extends Component
{

    use WireUiActions;

    public BookingForm $form;

    public function mount(?string $dateTime = null): void
    {
        if ($dateTime) {
            $this->form->dateTime = Carbon::parse($dateTime)->format('Y-m-d H:i');
        }
    }


    public function save(): void
    {
        $this->form->validate();

        try {
            Booking::create([
                'dog_id' => $this->form->dogId,
                'scheduled_at' => Carbon::parse($this->form->dateTime),
                'amount' => $this->form->amount,
                'notes' => $this->form->notes,
                'treatment' => $this->form->treatment,
                'ends_at' => Carbon::parse($this->form->dateTime)->setTimeFromTimeString($this->form->endsTime)
            ]);

            $this->notification()->success('Successfully created booking');
        } catch (\Exception $e) {
            $this->notification()->error('Error at creating booking. Contact your administrator');
            activity('booking')
                ->withProperties(['error' => $e->getMessage()])
                ->log('Error at creating a booking record');
        }

        $this->dispatch('modal-close');
        $this->dispatch('refresh-bookings');
    }

    #[On('refresh-dogs')]
    public function refreshOnAction(): void
    {
    }

    public function render(): View
    {
        $dogs = Dog::all();
        return view('livewire.modal.booking-create', compact('dogs'));
    }
}
