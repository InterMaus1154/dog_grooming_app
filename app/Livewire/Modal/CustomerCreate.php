<?php

namespace App\Livewire\Modal;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CustomerCreate extends Component
{
    use WireUiActions;

    public CustomerForm $form;

    public function save(): void
    {
        $this->validate();

        try {
            Customer::create([
                'name' => $this->form->name,
                'phone_number' => $this->form->phoneNumber
            ]);
            $this->notification()->success('Customer successfully created!');
        } catch (\Exception $e) {
            $this->notification()->error('Error at creating a new customer. Contact your administrator');
            activity('customer')
                ->withProperties(['error' => $e->getMessage()])
                ->log('Error at creating a customer record');
        }

        $this->dispatch('modal-close');
        $this->dispatch('refresh-customers');
    }

    public function render(): View
    {
        return view('livewire.modal.customer-create');
    }
}
