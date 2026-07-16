<?php

namespace App\Modules\ChristianPagupitan\Models;

use Illuminate\Database\Eloquent\Model;

class BarberItem extends Model
{
    protected $table = 'barber_items';

    protected $fillable = [
        'name',
        'price',
        'category',
    ];
}