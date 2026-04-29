<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;
use App\Models\DogBreed;
use App\Models\Booking;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Dog extends Model
{
    use SoftDeletes, LogsActivity;

    public function dogBreed(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DogBreed::class, 'dog_breed_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'dog_id', 'id');
    }
}
