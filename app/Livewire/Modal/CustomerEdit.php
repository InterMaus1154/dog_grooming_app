<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CustomerEdit extends Component
{
    use WireUiActions;

    public CustomerForm $form;
    public Customer $customer;

    public function mount(int $id): void
    {
        $this->customer = Customer::findOrFail($id);

        $this->form->name = $this->customer->name;
        $this->form->phoneNumber = $this->customer->phone_number;
    }

    public function save(): void
    {
        $this->validate();

        $this->customer->update([
            'name' => $this->form->name,
            'phone_number' => $this->form->phoneNumber
        ]);

        $this->notification()->success('Customer successfully updated!');
        $this->dispatch('refresh-customers');
        $this->dispatch('modal-clear');
    }

    public function render(): View
    {
        return view('livewire.modal.customer-edit');
    }
}
