<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatus;
use App\Models\Dog;
use App\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use SoftDeletes;
    public function dog()
    {
        return $this->belongsTo(Dog::class, 'dog_id', 'id');
    }

    public function customer()
    {
        return $this->through('dog')->has('customer');
    }
}
