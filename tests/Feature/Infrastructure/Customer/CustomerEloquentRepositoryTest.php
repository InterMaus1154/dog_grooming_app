<?php

namespace Infrastructure\Customer;

use App\Domain\Customer\Contracts\CustomerRepository;
use App\Infrastructure\Customer\CustomerEloquentRepository;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Tests\TestHelpers;

class CustomerEloquentRepositoryTest extends TestCase
{
    use TestHelpers, RefreshDatabase;

    private CustomerEloquentRepository $customers;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customers = app(CustomerRepository::class);
    }

    #[Test]
    public function it_commits_a_new_customer(): void
    {
        $customer = new Customer();
        $customer->setName('John');
        $customer = $this->customers->commit($customer);
        $this->assertNotNull($this->customers->findById($customer->getId()));
        $this->assertSame('John', $customer->getName());
    }

    #[Test]
    public function it_returns_a_customer_with_a_valid_id(): void
    {
        $customer = $this->createCustomer();
        $this->assertNotNull($this->customers->findById($customer->getId()));
    }

    #[Test]
    public function it_returns_null_when_customer_doesnt_exist(): void
    {
        $this->assertNull($this->customers->findById(9999));
    }

    #[Test]
    public function it_updates_a_customer(): void
    {
        $customer = $this->createCustomer();
        $customer->setName('Test Update');
        $this->customerRepository()->commit($customer);
        $this->assertNotNull($this->customerRepository()->findById($customer->getId()));
        $updated = $this->customerRepository()->findById($customer->getId());
        $this->assertSame($updated->getId(), $customer->getId());
        $this->assertSame('Test Update', $updated->getName());
    }

    #[Test]
    public function it_deletes_a_customer(): void
    {
        $customer = $this->createCustomer();
        $this->customerRepository()->delete($customer);
        $this->assertNotNull($customer->getDeletedAt());
        $this->assertNull($this->customerRepository()->findById($customer->getId()));
    }

    #[Test]
    public function it_restores_a_customer(): void
    {
        $customer = $this->createCustomer();
        $this->customerRepository()->delete($customer);
        $this->assertNotNull($customer->getDeletedAt());
        $this->assertNull($this->customerRepository()->findById($customer->getId()));
        $this->customerRepository()->restore($customer);
        $this->assertNotNull($this->customerRepository()->findById($customer->getId()));
    }

    #[Test]
    public function it_finds_deleted_if_flag_is_true(): void
    {
        $customer = $this->createCustomer();
        $this->customerRepository()->delete($customer);
        $this->assertNotNull($this->customerRepository()->findById($customer->getId(), withDeleted: true));
    }

}
