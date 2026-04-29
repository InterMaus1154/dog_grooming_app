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

class DogEdit extends Component
{

    use WireUiActions;

    public DogForm $form;
    public Dog $dog;

    public function mount(int $id): void
    {
        $this->dog = Dog::findOrFail($id);
        $this->form->name = $this->dog->name;
        $this->form->breedId = $this->dog->dog_breed_id;
        $this->form->customerId = $this->dog->customer_id;
    }


    #[On('refresh-customers')]
    #[On('refresh-breeds')]
    public function eventOnRefresh(): void
    {
    }

    public function save(): void
    {
        $this->form->validate();

        try {
            $this->dog->update([
                'name' => $this->form->name,
                'dog_breed_id' => $this->form->breedId,
                'customer_id' => $this->form->customerId
            ]);
            $this->notification()->success('Dog successfully updated');
        } catch (\Exception $e) {
            $this->notification()->error('Error at updating dog');
            activity('dog')
                ->withProperties(['e' => $e->getMessage()])
                ->on($this->dog)
                ->log('Error at updating a dog record');
        }

        $this->dispatch('modal-close');
        $this->dispatch('refresh-dogs');

    }

    public function render(): View
    {
        $customers = Customer::query()->orderBy('name')->get();
        $breeds = DogBreed::all();
        return view('livewire.modal.dog-edit', compact('customers', 'breeds'));
    }
}
