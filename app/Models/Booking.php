<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatus;
use App\Models\Dog;
use App\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Booking extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['dog_id', 'status', 'scheduled_at', 'notes', 'treatment', 'amount', 'ends_at'];

    public function dog()
    {
        return $this->belongsTo(Dog::class, 'dog_id', 'id');
    }

    public function customer()
    {
        return $this->hasOneThrough(Customer::class, Dog::class, 'id', 'id', 'dog_id', 'customer_id');
    }

    protected $casts = [
        'scheduled_at' => 'datetime',
        'ends_at' => 'datetime',
        'status' => BookingStatus::class,
        'created_at' => 'datetime'
    ];

    public function getTitle(): string
    {
        if($this->hasDog()){
            return $this->getDog()->getName();
        }

        if($this->hasTitle()){
            return $this->getAttribute('title');
        }

        return "(No dog selected)";
    }

    public function hasDog(): bool
    {
        return !is_null($this->getDogId());
    }

    public function hasTitle(): bool
    {
        return !is_null($this->getAttribute('title'));
    }

    public function getDogId(): ?int
    {
        return $this->getAttribute('dog_id');
    }

    public function getDog(): ?Dog
    {
        return is_null($this->getDogId()) ? null : $this->dog;
    }

    public function getCustomer(): ?Customer
    {
        return is_null($this->getDogId()) ? null : $this->customer;
    }
}
