<?php

namespace App\Infrastructure\Customer;

use App\Domain\Customer\Contracts\CustomerRepository;
use App\Models\Customer;

class CustomerEloquentRepository implements CustomerRepository
{
    public function commit(Customer $customer): Customer
    {
        return tap($customer)->save();
    }

    public function findById(int $id, bool $withDeleted = false): ?Customer
    {
        $query = Customer::query()
            ->where('id', $id);

        if($withDeleted){
            $query->withTrashed();
        }

        return $query->first();
    }

    public function delete(Customer $customer): Customer
    {
        $customer->markDeleted();
        return $this->commit($customer);
    }

    public function restore(Customer $customer): Customer
    {
        $customer->restoreFromDeleted();
        return $this->commit($customer);
    }

}
