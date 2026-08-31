<?php

namespace App\Livewire\Customer;


use App\Enums\LivewireEvent;
use App\Models\Customer;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\WireUiActions;

class CustomerList extends Component
{
    use HasSort, HasFilter, WithPagination, WireUiActions;

    public function mount(): void
    {
        $this->initSort('name', 'asc');
    }

    public function customFilters(): array
    {
        return [
            'search' => function (Builder $builder, $value) {
                return $builder->where('name', 'like', sprintf('%%%s%%', $value))->orWhere('phone_number', 'like', sprintf('%%%s%%', $value));
            }
        ];
    }

    /**
     * @return Builder<Customer>
     */
    public function createQuery(): Builder
    {
        $query = Customer::query();
        $query = $this->applyFilters($query, $this->customFilters());
        $query = $this->applySort($query)->withCount('dogs', 'bookings');
        return $query;
    }


    #[On(LivewireEvent::REFRESH_CUSTOMERS->value)]
    public function refreshOnAction(): void
    {

    }

    public function deleteCustomer(Customer $customer): void
    {

        if ($customer->dogs()->count() > 0) {
            $this->dispatch(LivewireEvent::MODAL_OPEN->value, 'modal.alert', [
                'title' => 'Cannot proceed',
                'message' => 'A customer with dogs/bookings cannot be deleted'
            ]);
            return;
        }

        $this->dispatch(LivewireEvent::MODAL_OPEN->value, 'modal.confirm', [
                'message' => sprintf("This will delete customer '%s'", $customer->name),
                'event' => LivewireEvent::CUSTOMER_DELETE->value,
                'eventData' => [$customer]
            ]
        );
    }

    #[On(LivewireEvent::CUSTOMER_DELETE->value)]
    public function deleteCustomerEventReceiver(Customer $customer): void
    {
        $customer->delete();
        $this->notification()->success('Customer has been deleted');
    }

    public function render(): View
    {
        return view('livewire.customer.customer-list', [
            'customers' => $this->createQuery()->paginate(15)
        ]);
    }
}
