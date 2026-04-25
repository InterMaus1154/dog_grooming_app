<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;
use App\Models\DogBreed;

class Dog extends Model
{
    use SoftDeletes;

    public function dogBreed(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DogBreed::class, 'dog_breed_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
