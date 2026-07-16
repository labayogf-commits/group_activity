<?php

namespace App\Modules\MedicineInventory\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'quantity',
        'expiry_date',
    ];

    protected $casts = [
        'expiry_date' => 'date',
    ];
}