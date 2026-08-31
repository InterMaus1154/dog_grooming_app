<?php

namespace App\Livewire\Modal;

use App\Enums\LivewireEvent;
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
        $this->form->notes = $this->dog->notes;
    }


    #[On(LivewireEvent::REFRESH_CUSTOMERS->value)]
    #[On(LivewireEvent::REFRESH_BREEDS->value)]
    #[On(LivewireEvent::REFRESH_DOGS->value)]
    public function eventOnRefresh(): void
    {
    }

    public function save(): void
    {
        $this->form->validateAll();

        try {
            $this->dog->update([
                'name' => $this->form->name,
                'dog_breed_id' => $this->form->breedId,
                'customer_id' => $this->form->customerId,
                'notes' => $this->form->notes
            ]);
            $this->notification()->success('Dog successfully updated');
        } catch (\Exception $e) {
            $this->notification()->error('Error at updating dog');
            activity('dog')
                ->withProperties(['e' => $e->getMessage()])
                ->on($this->dog)
                ->log('Error at updating a dog record');
        }

        $this->dispatch(LivewireEvent::MODAL_CLOSE->value);
        $this->dispatch(LivewireEvent::REFRESH_DOGS->value);

    }

    public function render(): View
    {
        $customers = Customer::query()->orderBy('name')->get();
        $breeds = DogBreed::all();
        return view('livewire.modal.dog-edit', compact('customers', 'breeds'));
    }
}
