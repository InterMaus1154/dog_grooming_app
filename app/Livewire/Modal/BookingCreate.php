<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\BookingForm;
use App\Models\Dog;
use Illuminate\View\View;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Attributes\On;
use Livewire\Component;

class BookingCreate extends Component
{

    public BookingForm $form;

    public function mount(?string $date = null): void
    {
        $this->form->date = $date;
    }


    public function save(): void
    {
        $this->form->validate();
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
