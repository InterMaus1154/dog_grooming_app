<?php

namespace App\Livewire\Modal;

use App\Data\CreateCustomerData;
use App\Enums\LivewireEvent;
use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class CustomerCreate extends Component
{
    use WireUiActions;

    public CustomerForm $form;

    private CustomerService $customerService;

    public function boot(): void
    {

    }

    public function save(): void
    {
        $this->validate();

        try {
            Customer::create([
                'name' => $this->form->name,
                'phone_number' => $this->form->phoneNumber
            ]);
            $this->customerService->createCustomer();
            $this->notification()->success('Customer successfully created!');
        } catch (\Exception $e) {
            $this->notification()->error('Error at creating a new customer. Contact your administrator');
            activity('customer')
                ->withProperties(['error' => $e->getMessage()])
                ->log('Error at creating a customer record');
        }

        $this->dispatch(LivewireEvent::MODAL_CLOSE->value);
        $this->dispatch(LivewireEvent::REFRESH_CUSTOMERS->value);
    }

    public function render(): View
    {
        return view('livewire.modal.customer-create');
    }
}
