<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dog;

class Customer extends Model
{
    use SoftDeletes;

    public function dogs()
    {
        return $this->hasMany(Dog::class, 'customer_id', 'id');
    }

    public function bookings()
    {
        return $this->through('dogs')->has('bookings');
    }
}
