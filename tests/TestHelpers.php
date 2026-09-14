<?php

namespace Tests;

use App\Domain\Customer\Contracts\CustomerRepository;
use App\Models\Customer;

trait TestHelpers
{

    private int $customerId = 1;

    public function createCustomer(array $overrides = []): Customer
    {
        $customer = Customer::factory([
            'name' => $overrides['name'] ?? 'Test Customer ' . $this->customerId++,
            'phone_number' => $overrides['phone_number'] ?? '4471234567',
            'is_active' => $overrides['is_active'] ?? true
        ]);
        $customer->setId($this->customerId);

        return $this->customerRepository()->commit($customer);
    }

    private function customerRepository(): CustomerRepository
    {
        return $this->app->make(CustomerRepository::class);
    }
}
