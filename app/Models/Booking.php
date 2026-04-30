<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\BookingStatus;
use App\Models\Dog;
use App\Models\Customer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Concerns\LogsActivity;

class Booking extends Model
{
    use SoftDeletes, LogsActivity;

    protected $fillable = ['dog_id', 'status', 'scheduled_at', 'notes', 'treatment', 'amount'];

    public function dog()
    {
        return $this->belongsTo(Dog::class, 'dog_id', 'id');
    }

    public function customer()
    {
        return $this->through('dog')->has('customer');
    }
}
