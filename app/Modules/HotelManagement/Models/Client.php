<?php

namespace App\Modules\HotelManagement\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
    ];
}
