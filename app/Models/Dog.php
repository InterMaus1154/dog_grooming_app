<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{

    public function dogBreed(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DogBreed::class, 'dog_breed_id', 'id');
    }

}
