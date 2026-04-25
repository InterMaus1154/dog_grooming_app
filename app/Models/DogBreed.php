<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dog;

class DogBreed extends Model
{
    public function dogs()
    {
        return $this->hasMany(Dog::class, 'dog_breed_id', 'id');
    }
}
