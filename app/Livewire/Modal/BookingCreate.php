<?php

namespace App\Livewire\Modal;

use App\Enums\LivewireEvent;
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

    public function mount(?string $dateTime = null, ?int $dogId = null): void
    {
        if ($dateTime) {
            $this->form->dateTime = Carbon::parse($dateTime)->format('Y-m-d H:i');
        }

        if ($dogId) {
            $this->form->dogId = $dogId;
        }
    }

    public function save(): void
    {
        $this->form->validateAll();

        try {
            Booking::create([
                'dog_id' => $this->form->dogId,
                'scheduled_at' => Carbon::parse($this->form->dateTime),
                'amount' => $this->form->amount,
                'notes' => $this->form->notes,
                'treatment' => $this->form->treatment,
                'ends_at' => Carbon::parse($this->form->dateTime)->setTimeFromTimeString($this->form->endsTime),
                'title' => $this->form->title,
            ]);

            $this->notification()->success('Successfully created booking');
        } catch (\Exception $e) {
            $this->notification()->error('Error at creating booking. Contact your administrator');
            activity('booking')
                ->withProperties(['error' => $e->getMessage()])
                ->log('Error at creating a booking record');
        }

        $this->dispatch(LivewireEvent::MODAL_CLOSE->value);
        $this->dispatch(LivewireEvent::REFRESH_BOOKINGS->value);
    }

    #[On(LivewireEvent::REFRESH_DOGS->value)]
    public function noop(): void
    {
    }

    public function render(): View
    {
        $dogs = Dog::query()
            ->with(['dogBreed'])
            ->get()
            ->map(function (Dog $dog) {
                $name = $dog->getName();
                if ($dog->hasBreed()) {
                    $name .= ' (' . $dog->dogBreed->getName() . ')';
                }
                return [
                    'id' => $dog->id,
                    'name' => $name,
                ];
            })
            ->toArray();
        return view('livewire.modal.booking-create', compact('dogs'));
    }
}
