<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dog;
use Illuminate\Database\Eloquent\SoftDeletes;

class DogBreed extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    public function dogs()
    {
        return $this->hasMany(Dog::class, 'dog_breed_id', 'id');
    }
}
