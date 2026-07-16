<?php

namespace App\Modules\ResortBooking\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
