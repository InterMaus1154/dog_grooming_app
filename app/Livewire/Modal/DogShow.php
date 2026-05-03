<?php

namespace App\Livewire\Modal;

use App\Models\Booking;
use App\Models\Dog;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class DogShow extends Component
{

    public Dog $dog;

    public function mount(int $id): void
    {
        $this->dog = Dog::with(['dogBreed', 'customer'])->withCount('bookings')->findOrFail($id);
    }

    #[On('refresh-bookings')]
    #[On('refresh-dogs')]
    public function eventReceiver(): void
    {
    }

    public function render(): View
    {
        $upcomingBooking = $this->dog->bookings()
            ->whereDate('scheduled_at', '>=', today())
            ->oldest('scheduled_at')
            ->first();

        $previousBooking = $this->dog->bookings()
            ->whereDate('scheduled_at', '<', today())
            ->latest('scheduled_at')
            ->first();


        return view('livewire.modal.dog-show', compact('previousBooking', 'upcomingBooking'));
    }
}
