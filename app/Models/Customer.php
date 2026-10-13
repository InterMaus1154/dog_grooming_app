<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dog;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Customer extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['name', 'phone_number'];

    /**
     * @param array{name: string, phone_number: string|null, is_active: boolean} $data
     *
     * @return Customer
     */
    public static function factory(array $data): Customer
    {
        $customer = new Customer();
        $customer->forceFill([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'] ?? null,
            'is_active' => array_key_exists('is_active', $data) ? $data['is_active'] : true,
        ]);
        return $customer;
    }

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function setId(int $id): void
    {
        $this->setAttribute('id', $id);
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function setName(string $name): void
    {
        $this->setAttribute('name', $name);
    }

    public function getPhoneNumber(): ?string
    {
        return $this->getAttribute('phone_number');
    }

    public function setPhoneNumber(?string $phoneNumber = null): void
    {
        $this->setAttribute('phone_number', $phoneNumber);
    }

    public function isActive(): bool
    {
        return $this->getAttribute('is_active');
    }

    public function markActive(): void
    {
        $this->setAttribute('is_active', true);
    }

    public function markInactive(): void
    {
        $this->setAttribute('is_active', false);
    }

    public function toggleActive(): void
    {
        if($this->isActive()){
            $this->markInactive();
        }else{
            $this->markActive();
        }
    }

    public function isDeleted(): bool
    {
        return !is_null($this->getAttribute('deleted_at'));
    }

    public function markDeleted(): void
    {
        $this->setAttribute('deleted_at', now()->toIso8601String());
    }

    public function restoreFromDeleted(): void
    {
        $this->setAttribute('deleted_at', null);
    }

    public function getDeletedAt(): ?CarbonInterface
    {
        return $this->getAttribute('deleted_at');
    }

    public function dogs()
    {
        return $this->hasMany(Dog::class, 'customer_id', 'id');
    }

    public function bookings()
    {
        return $this->through('dogs')->has('bookings');
    }

}
