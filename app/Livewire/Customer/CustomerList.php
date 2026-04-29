<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use App\Traits\HasFilter;
use App\Traits\HasSort;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerList extends Component
{
    use HasSort, HasFilter, WithPagination;

    public function mount(): void
    {
        $this->initSort('name', 'asc');
    }

    public function customFilters(): array
    {
        return [
            'name' => fn(Builder $builder, $value) => $builder->where('name', 'like', sprintf('%%%s%%', $value))
        ];
    }


    /**
     * @return Builder<Customer>
     */
    public function createQuery(): Builder
    {
        $query = Customer::query();
        $query = $this->applyFilters($query, $this->customFilters());
        $query = $this->applySort($query);
        return $query;
    }



    #[On('refresh-customers')]
    public function refreshOnAction(): void
    {
        $this->dispatch('$refresh');
    }

    public function render(): View
    {
        return view('livewire.customer.customer-list', [
            'customers' => $this->createQuery()->paginate(15)
        ]);
    }
}
