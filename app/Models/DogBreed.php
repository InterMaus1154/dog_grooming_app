<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dog;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class DogBreed extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['name'];

    public function dogs()
    {
        return $this->hasMany(Dog::class, 'dog_breed_id', 'id');
    }
}
