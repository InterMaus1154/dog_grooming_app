<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\DogForm;
use App\Models\Customer;
use App\Models\Dog;
use App\Models\DogBreed;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class DogCreate extends Component
{
    use WireUiActions;

    public DogForm $form;

    public function save(): void
    {
        $this->form->validate();

        try {
            Dog::create([
                'customer_id' => $this->form->customerId,
                'dog_breed_id' => $this->form->breedId,
                'name' => $this->form->name
            ]);
        } catch (\Exception $e) {
            $this->notification()->error('Failed to create a new dog record. Contact your administrator');
            activity('dog')
                ->withProperties(['error' => $e->getMessage()])
                ->log('Error at creating a dog record');
        }

        $this->dispatch('modal-clear');
        $this->dispatch('refresh-dogs');

    }

    #[On('refresh-customers')]
    #[On('refresh-breeds')]
    public function refreshCustomers(): void
    {
    }

    public function render(): View
    {
        $customers = Customer::query()->orderBy('name')->get();
        $breeds = DogBreed::all();

        return view('livewire.modal.dog-create', compact('customers', 'breeds'));
    }
}
