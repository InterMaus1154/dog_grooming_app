<?php

namespace App\Domain\Customer\Contracts;

use App\Models\Customer;

interface CustomerRepository
{
    public function commit(Customer $customer): Customer;

    public function findById(int $id, bool $withDeleted = false): ?Customer;

    public function delete(Customer $customer): Customer;

    public function restore(Customer $customer): Customer;
}
