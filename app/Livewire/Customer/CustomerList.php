<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerList extends Component
{
    use HasSort, HasFilter, WithPagination;


    /**
     * @return Builder<Customer>
     */
    public function createQuery(): Builder
    {
        $query = Customer::query();
        $query = $this->applyFilters($query);
        $query = $this->applySort($query);
        return $query;
    }

    public function render(): View
    {
        return view('livewire.customer.customer-list', [
            'customers' => $this->createQuery()->paginate(15)
        ]);
    }
}
