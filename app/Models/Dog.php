<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dog extends Model
{
    use SoftDeletes;

    public function dogBreed(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(DogBreed::class, 'dog_breed_id', 'id');
    }

}
